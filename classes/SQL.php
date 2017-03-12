<?php

	class SQL
	{
		/** 
	     * Connexion à la BDD
	     *
	     * @var PDO
	     * @access private
	     */
	    private $conn;

	    /**
	     * Nom du fichier SQL
	     *
	     * @var string
	     * @access private
	     */
	    private $filename;

	    /**
	     * Singleton SQL
	     *
	     * @var SQL
	     * @access private
	     * @static
	     */
	    private static $_instance;

	    /**
	     * Constructeur de la classe.
	     *
	     * Le constructeur est privé car on interdit de créer des objets de manière désordonné.
	     * On utilisera plutôt la méthode static getInstance qui permet de récupérer (créer si nécessaire)
	     * un objet de type SQL et surtout d'en limiter le nombre à un seul pour toute l'éxécution de l'application
	     * et ainsi de ne pas ouvrir et fermer des tas de connexion n'importe comment et sans contrôle.
	     *
	     * @param void
	     */
	    private function __construct()
	    {
	        $this->filename="base.db";
	        $this->boolConnexion = false;

	        try {
	            $this->conn = new PDO("sqlite:".$this->filename);
	            $this->boolConnexion = true;
	        } catch (PDOException $e) {
	            die("Connection à la base de données échoué" . $e->getMessage());
	        }
	    }

	    /**
	     * Méthode qui crée l'unique instance de la classe
	     * si elle n'existe pas encore puis la retourne.
	     *
	     * @param void
	     * @return SQL : $_instance
	     */
	    public static function getInstance()
	    {
	        if (is_null(self::$_instance)) {
	            self::$_instance = new SQL();
	        }

	        return self::$_instance;
	    }

	    /**
	     * Méthode qui retourne le booléen de connexion
	     *
	     * @param void
	     * @return bool : $boolConnexion
	     */
	    public function getBoolConnexion()
	    {
	        return $this->boolConnexion;
	    }


		/**
	     * Méthode qui initialise la base de donnée en créant les différents tables
	     *
	     * @param void
	     * @return bool : True si la création est réussie, False sinon
	     */
	    public function createTables()
	    {
	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	users(	'id_user' INTEGER PRIMARY KEY NOT NULL,
						'mail' TEXT NOT NULL UNIQUE,
						'password' TEXT NOT NULL,
						'status' INT NOT NULL CHECK (status > 1 AND status < 6),
						'subscription_date' DATE NOT NULL DEFAULT '2000-01-01'
						);");
	        //status : 2=visitor 3=subscriber 4=author 5=admin
	        if (!($query->execute())) {return false;}
	        $query->closeCursor();

	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	authors('id_author' INTEGER PRIMARY KEY NOT NULL,
	        			'name' TEXT NOT NULL UNIQUE,
	        			'user' INTEGER,	        			
	        			'description_filename' TEXT,
	        			'news_filename' TEXT,	        			
						FOREIGN KEY(user) REFERENCES users(id_user)
						);");
	        if (!($query->execute())) {return false;}
	        $query->closeCursor();

	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	books(	'id_book' INTEGER PRIMARY KEY NOT NULL,
	        			'title' TEXT UNIQUE NOT NULL,
	        			'authors' TEXT NOT NULL,	        			
	        			'collection' TEXT NOT NULL,						
						'year' INTEGER NOT NULL,
						'is_full' INTEGER CHECK (is_full > 1 AND is_full < 4), 
						'captions_filename' TEXT						
						);");
	        //le champ authors est un array des ids des auteurs serialisé
	        //les ids des auteurs devraient être des clefs étrangères, mais comme ils sont en string dans la BDD c'est pas possible...
			//le champs is_full vaut 2 si le livre est complet ou 3 si c'est un extrait
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui ajoute un utilisateur dans la table users de la base de donnée
	     *
	     * @param $user : un objet de la classe User.php
	     * @param string : $password - le mot de passe crypté de l'utilisateur 
	     * @return bool : True si l'ajout est réussi, False sinon
	     */
	    public function addUser($user, $password)
	    {
	    	$query = $this->conn->prepare("INSERT INTO users(mail, password, status, subscription_date) VALUES(?,?,?,?);");
	    	$query-> bindValue(1,$user->getUserMail()); 	
	    	$query-> bindValue(2,password_hash($password, PASSWORD_BCRYPT));
	    	$query-> bindValue(3,$user->getUserStatus());
	    	$query-> bindValue(4,$user->getUserSubscriptionDate());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui ajoute un auteur dans la table authors de la base de donnée
	     *
	     * @param $author : un objet de la classe Author.php
	     * @return bool : True si l'ajout est réussi, False sinon
	     */
	    public function addAuthor($author)
	    {
	    	$query = $this->conn->prepare("INSERT INTO authors(name, user, description_filename, news_filename) VALUES(?,?,?,?);");
	    	$query-> bindValue(1,$author->getAuthorName());
	    	$query-> bindValue(2,$author->getAuthorAccount());
	    	$query-> bindValue(3,$author->getAuthorDescription());
	    	$query-> bindValue(4,$author->getAuthorNews());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui ajoute un livre dans la table books de la base de donnée 
	     * 
	     *
	     * @param $book : un objet de la classe Book.php
	     * @return bool : True si l'ajout est réussi, False sinon
	     */
	    public function addBook($book)
	    {
	    	//Je vais ajouter mon livre à ma table books
	    	//On va commencer par vérifier que chaque auteur du book existe
	    	//A cause de la façon de stocker le champ authors dans books, je peux pas les définir comme clef étrangère de la table authors
	    	//Du coup je fais la vérification à la main...
	    	$authorsExistsArray = array();
	    	$authors_ids = $book->getBookAuthors();
	    	foreach ($book->getBookAuthors() as $key => $author_id) {
	    		$curAuthorExists = FALSE;
	    		//echo "<br>un id d'auteur cherche=".$author_id;
	    		$query = $this->conn->prepare("SELECT 1 FROM authors WHERE id_author=?;");
	    		$query-> bindValue(1,$author_id);
			    if ($query->execute()) {
			    	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			    		$curAuthorExists = TRUE;
			    	}
			    	$authorsExistsArray[] = $curAuthorExists;
			    }
	    	}

	    	if (count($authors_ids) === count ($authorsExistsArray)) {
	    		//les deux listes ont la même taille
	    		if (in_array(FALSE, $authorsExistsArray, true)) {
	    			//echo "<br>IL Y A UN FALSE DANS L'ARRAY!";
	    			//il y a un FALSE, donc au moins un auteur n'a pas été trouvé
	    		} else {
	    			//on a retrouvé tous les auteurs, on peut ajouter notre livre
	    			$query = $this->conn->prepare("INSERT INTO books(title, authors, collection, year, is_full, captions_filename) VALUES(?,?,?,?,?,?);");
			    	$query-> bindValue(1,$book->getBookTitle());
			    	$query-> bindValue(2,serialize($book->getBookAuthors()));
			    	$query-> bindValue(3,$book->getBookCollection());
			    	$query-> bindValue(4,$book->getBookYear());
			    	$query-> bindValue(5,$book->getBookIsFull());
			    	$query-> bindValue(6,$book->getBookCaptions());
			    	return $query->execute();
	    		}		    	
	    	} 
	    	//un des auteurs du champ "authors" du livre existe pas dans la base
	    	return FALSE;	    	
	    }

	    /**
	    * Méthode qui retourne l'id d'un livre en effectuant une recherche sur les titres
	    * 
	    * @param string : le titre du livre cherché
	    * @return int : l'id du livre cherché
	    */
		/*
	    public function getBookIDByTitle ($book_title)
	    {
	    	$query = $this->conn->prepare("SELECT id_book FROM books WHERE title=?;");
	    	$query-> bindValue($book_title);;
	    	$id_book = NULL;
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$id_book = $row['id_book'];
	    		}
	    	}
	    	return $id_book;
	    }
	   

	    /**
	    * Méthode qui récupère un user en le cherchant grâce à son mail
	    * 
	    *
	    * @param $mail : le mail de l'utilisateur
	    * @return User : l'objet User qui correspond à l'utilisateur trouvé 
	    */
	    public function getUserByExactMail($mail)
	    {
	    	$user_serialized = null;
	    	$query = $this->conn->prepare("SELECT * FROM users WHERE mail=?;");
	    	$query-> bindValue(1,$mail);
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$user = new User($row['id_user'], $row['mail'], $row['status'], $row['subscription_date']);
	    			$user_serialized = serialize($user);
	    		}
	    	}
	    	return $user_serialized;
	    }

	    /**
	    * Méthode qui récupère un user en le cherchant grâce à son mail
	    * 
	    *
	    * @param $mail : le mail de l'utilisateur
	    * @return User : l'objet User qui correspond à l'utilisateur trouvé 
	    */
	    public function getUserByMail($mail)
	    {
	    	$user_serialized = null;
	    	$query = $this->conn->prepare("SELECT * FROM users WHERE mail LIKE ?;");
	    	$query-> bindValue(1,$mail);
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$user = new User($row['id_user'], $row['mail'], $row['status'], $row['subscription_date']);
	    			$user_serialized = serialize($user);
	    		}
	    	}
	    	return $user_serialized;
	    }

	    /**
	     * Méthode qui vérifie que le mot de passe entrée correspond à l'utilisateur entrée
	     * 
	     *
	     * @param $mail : le mail de l'utilisateur
	     * @param $pswd : le mot de passe de l'utilisateur
	     * @return bool : est-ce que le mot de passe de cet utilisateur correspond à celui fourni
	     */
	    public function checkUserPassword($mail, $pswd)
	    {
	    	$response = false;
	    	$query = $this->conn->prepare("SELECT password FROM users WHERE mail=?;");
	    	$query-> bindValue(1,$mail);
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {	    			
	    			$response = (password_verify($pswd,$row['password'])) ? true : false ;
	    		}
	    	}
	    	return $response;
	    }

	     /**
	     * Méthode qui récupère un auteur en le cherchant grâce à son nom
	     * 
	     *
	     * @param $name : le nom de l'auteur
	     * @return Author : l'objet Author qui correspond à l'auteur trouvé 
	     */
	    public function getAuthorByName($name)
	    {
	    	$author_serialized = null;
	    	$query = $this->conn->prepare("SELECT * FROM authors WHERE name=?;");
	    	$query-> bindValue(1,$name);
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$author = new Author($row['id_author'], $row['name'], $row['user'], $row['description_filename'], $row['news_filename']);
	    			$author_serialized = serialize($author);
	    		}
	    	}
	    	return $author_serialized;
	    }

	    /**
	     * Méthode qui récupère un livre en le cherchant grâce à son titre
	     * 
	     *
	     * @param $titre : le titre du livre
	     * @return Book : l'objet Book qui correspond au livre trouvé 
	     */
	    public function getBookByTitle($title)
	    {
	    	$book_serialized = null;
	    	$query = $this->conn->prepare("SELECT * FROM books WHERE title=?;");
	    	$query-> bindValue(1,$title);
	    	if ($query->execute()) 
	    	{
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$book = new Book($row['id_book'], $row['title'], unserialize($row['authors']), $row['collection'], $row['year'], $row['is_full'],  $row['captions_filename']);
	    			$book_serialized = serialize($book);
	    		}
	    	}
	    	return $book_serialized;
	    }

	    /**
	     * Méthode qui modifie le mail d'un utilisateur dans la table users de la base de donnée
	     *
	     * @param $user : un objet de la classe User.php
	     * @param string : $new_mail - le nouveau mail de l'utilisateur 
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setUserMail($user, $new_mail)
	    {
	    	//Le mail doit être unique, on vérifie donc si ce mail est déjà associé à un compte
	    	$mail_already_used = FALSE;
	    	$check_query = $this->conn->prepare("SELECT * FROM users WHERE mail=?;");
	    	$check_query-> bindValue(1,$new_mail);
	    	if ($check_query->execute()) {
	    		while ($row = $check_query->fetch(PDO::FETCH_ASSOC)) {
	    			$mail_already_used = TRUE;
	    		}
	    	}

	    	if ($mail_already_used) {
	    		return FALSE;
	    	} else {
	    		$query = $this->conn->prepare("UPDATE users SET mail = ? WHERE id_user = ?");
		    	$query-> bindValue(1,$new_mail); 	
		    	$query-> bindValue(2,$user->getUserID());
		    	return $query->execute();
	    	}	    	
	    }

	    /**
	     * Méthode qui modifie le mot de passe d'un utilisateur dans la table users de la base de donnée
	     *
	     * @param $user : un objet de la classe User.php
	     * @param string : $new_pswd - le nouveau mot de passe de l'utilisateur 
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setUserPassword($user, $new_pswd)
	    {
	    	$query = $this->conn->prepare("UPDATE users SET password = ? WHERE id_user = ?");
	    	$query-> bindValue(1,$new_pswd); 	
	    	$query-> bindValue(2,$user->getUserID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le statut d'un utilisateur dans la table users de la base de donnée
	     *
	     * @param $user : un objet de la classe User.php
	     * @param string : $new_status - le nouveau statut de l'utilisateur 
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setUserStatus($user, $new_status)
	    {
	    	$query = $this->conn->prepare("UPDATE users SET status = ? WHERE id_user = ?");
	    	$query-> bindValue(1,$new_status); 	
	    	$query-> bindValue(2,$user->getUserID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le statut d'un utilisateur dans la table users de la base de donnée
	     *
	     * @param $user : un objet de la classe User.php
	     * @param string : $new_sub_date - la date de la dernière cotisation de l'utilisateur 
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setUserSubscriptionDate($user, $new_sub_date)
	    {
	    	$query = $this->conn->prepare("UPDATE users SET subscription_date = ? WHERE id_user = ?");
	    	$query-> bindValue(1,$new_sub_date); 	
	    	$query-> bindValue(2,$user->getUserID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le champ nom d'un auteur de la table authors de la base de donnée
	     *
	     * @param $author : un objet de la classe Author.php
	     * @param string : $new_name - le nouveau nom de l'auteur
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setAuthorName($author, $new_name)
	    {
	    	$query = $this->conn->prepare("UPDATE authors SET name = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_name); 	
	    	$query-> bindValue(2,$author->getAuthorID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie l'id de l'utilisateur associé à l'élément de la table authors de la base de donnée
	     *
	     * @param $author : un objet de la classe Author.php
	     * @param string : $new_user_id - le nouveau id de l'utilisateur associé à l'auteur
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setAuthorUser($author, $new_user_id)
	    {
	    	$query = $this->conn->prepare("UPDATE authors SET user = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_user_id); 	
	    	$query-> bindValue(2,$author->getAuthorID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le lien vers le fichier de description associé à un auteur de la table authors de la base de donnée
	     *
	     * @param $author : un objet de la classe Author.php
	     * @param string : $new_description_filename - le lien vers le fichier de description associé à l'auteur
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setAuthorDescription($author, $new_description_filename)
	    {
	    	$query = $this->conn->prepare("UPDATE authors SET description_filename = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_description_filename); 	
	    	$query-> bindValue(2,$author->getAuthorID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le lien vers le fichier d'actualité associé à un auteur de la table authors de la base de donnée
	     *
	     * @param $author : un objet de la classe Author.php
	     * @param string : $new_news_filename - le lien vers le fichier d'actualité associé à l'auteur
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setAuthorNews($author, $new_news_filename)
	    {
	    	$query = $this->conn->prepare("UPDATE authors SET news_filename = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_news_filename); 	
	    	$query-> bindValue(2,$author->getAuthorID());
	    	return $query->execute();
	    }					

		/**
	     * Méthode qui modifie le titre d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param string : $new_title - le titre du livre
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookTitle($book, $new_title)
	    {
	    	$query = $this->conn->prepare("UPDATE books SET title = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_title); 	
	    	$query-> bindValue(2,$book->getBookID());
	    	return $query->execute();
	    }		    

	    /**
	     * Méthode qui modifie le ou les auteurs du livre d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param string : $new_authors - le ou les auteurs du livre
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookAuthors($book, $new_authors)
	    {
	    	//On va commencer par vérifier que chaque auteur du book existe
	    	$authorsExistsArray = array();
	    	foreach ($new_authors as $key => $author_id) {
	    		$curAuthorExists = FALSE;
	    		//echo "<br>un id d'auteur cherche=".$author_id;
	    		$query = $this->conn->prepare("SELECT 1 FROM authors WHERE id_author=?;");
	    		$query-> bindValue(1,$author_id);
			    if ($query->execute()) {
			    	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			    		$curAuthorExists = TRUE;
			    	}
			    	$authorsExistsArray[] = $curAuthorExists;
			    }
	    	}

	    	if (count($new_authors) === count ($authorsExistsArray)) {
	    		//les deux listes ont la même taille
	    		if (in_array(FALSE, $authorsExistsArray, true)) {
	    			//echo "<br>IL Y A UN FALSE DANS L'ARRAY!";
	    			//il y a un FALSE, donc au moins un auteur n'a pas été trouvé
	    		} else {
	    			//tout va bien, on update la table
	    			$query = $this->conn->prepare("UPDATE books SET authors = ? WHERE id_author = ?");
			    	$query-> bindValue(1,$new_authors); 	
			    	$query-> bindValue(2,$book->getBookID());
			    	return $query->execute();
	    		}		    	
	    	} 
	    	//un des auteurs du champ "authors" du livre existe pas dans la base
	    	return FALSE;	    	
	    }	

		/**
	     * Méthode qui modifie la collection d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param string : $new_collection - la collection à laquelle appartient le livre
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookCollection($book, $new_collection)
	    {
	    	$query = $this->conn->prepare("UPDATE books SET collection = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_collection); 	
	    	$query-> bindValue(2,$book->getBookID());
	    	return $query->execute();
	    }	    

	    /**
	     * Méthode qui modifie la date de publication d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param int : $new_year - la date de publication du livre
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookYear($book, $new_year)
	    {
	    	$query = $this->conn->prepare("UPDATE books SET year = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_year); 	
	    	$query-> bindValue(2,$book->getBookID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie l'état, complet ou pas, d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param int : $is_full - est-ce que ce livre est complet? vaut 2 si le livre est complet ou 3 si c'est un extrait
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookIsFull($book, $is_full)
	    {
	    	$query = $this->conn->prepare("UPDATE books SET is_full = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$is_full); 	
	    	$query-> bindValue(2,$book->getBookID());
	    	return $query->execute();
	    }

	    /**
	     * Méthode qui modifie le lien vers le fichier des légendes d'un livre de la table books de la base de donnée
	     *
	     * @param $book : un objet de la classe Book.php
	     * @param string : $new_captions_filename - le lien vers le fichier contenant les légendes du livre
	     * @return bool : True si la modification est réussi, False sinon
	     */
	    public function setBookCaptions($book, $new_captions_filename)
	    {
	    	$query = $this->conn->prepare("UPDATE books SET captions_filename = ? WHERE id_author = ?");
	    	$query-> bindValue(1,$new_captions_filename); 	
	    	$query-> bindValue(2,$book->getBookID());
	    	return $query->execute();
	    }

	    public function generatePassword() {
	    	//génération d'un mot de passe aléatoire pour le nouveau compte
			//https://www.it-connect.fr/php-generateur-de-mot-de-passe-parametrable/
			$caract = "ABCDEFGHIJKLMNOPQRSTYVWXYZabcdefghijklmnopqrstuvwyxz0123456789@*$=+";
			$possible_lenght = [9,10,11,12,12,13,14,15,16,17,18];
			$lenght = $possible_lenght[mt_rand(0,(count($possible_lenght)-1))];
			$nb_caract_possible = strlen($caract);
			$generated_password = '';
			for($i = 1; $i <= $lenght; $i++) {
				$generated_password = $generated_password.$caract[mt_rand(0,$nb_caract_possible-1)];
			}
			return $generated_password;
	    }
	   

	    /*Structure de ma BDD :
	    Tables :
	    	-Users
	    	-Books
	    	-Author

		Méthodes nécessaires :
	    	-Users
	    		-addUser
	    		-getUset
	    		-editUser
	    		-deleteUser	    		
	    	-Books
	    		-getBook
	    		-addBook
	    		-editBook
	    		-deleteBook
	    	-Author
	    		-addAuthor
	    		-getAuthor
	    			-getAuthorBooks
	    			-getAuthorDescription
	    			-getAuthorNews
	    		-editAuthor
	    		-deleteAuthor    	
	    */
	}
?>