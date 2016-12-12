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
						'status' TEXT NOT NULL CHECK (status > 1 AND status < 6),
						'subscription_date' DATE NOT NULL DEFAULT '2000-01-01'
						);");
	        //status : 2=visitor 3=subscriber 4=author 5=admin
	        if (!($query->execute())) {return false;}

	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	authors('id_author' INTEGER PRIMARY KEY NOT NULL,
	        			'name' TEXT NOT NULL UNIQUE,
	        			'user' INTEGER,	        			
	        			'description_filename' TEXT,
	        			'news_filename' TEXT,	        			
						FOREIGN KEY(user) REFERENCES users(id_user)
						);");
	        if (!($query->execute())) {return false;}

	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	books(	'id_book' INTEGER PRIMARY KEY NOT NULL,
	        			'title' TEXT UNIQUE NOT NULL,
	        			'author' INTEGER,		        			
	        			'collection' TEXT NOT NULL,						
						'year' INTEGER NOT NULL,
						'is_full' INTEGER CHECK (is_full > 1 AND is_full < 4), 
						'captions_filename' TEXT,
						FOREIGN KEY(author) REFERENCES authors(id_author)
						);");
			//le champs is_full vaut 2 si le livre est complet ou 3 si c'est un extrait

			/* TO DO : gérer la question de est-ce qu'un livre peut avoir plusieurs auteurs
			une solution envisageable : remplacer le champ author de la table books par ids_authors_string
			ce serait alors un string dans lequel on met tous les ids_authors avec un séparateur
			et je devrais donc ensuite remettre les ids_authors dans une array (de la classe Author)
			et faire une boucle dessus
			ou éventuellemnt vérifier qu'il y a qu'un auteur

	        if (!($query->execute())) {return false;}

	        $query = $this->conn->prepare("CREATE TABLE IF NOT EXISTS 
	        	written('authors' TEXT NOT NULL,
	        			'book' INTEGER REFERENCES books(id_book),
	        			PRIMARY KEY(author, book)
			*/

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
	    	$query-> bindValue(2,$password);
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
	     * puis ajoute l'id du livre et l'id de l'auteur dans la table written
	     * 
	     *
	     * @param $book : un objet de la classe Book.php
	     * @return bool : True si l'ajout est réussi, False sinon
	     */
	    public function addBook($book)
	    {
	    	//Je vais ajouter mon livre à ma table books
	    	$query = $this->conn->prepare("INSERT INTO books(title, author, collection, year, is_full, captions_filename) VALUES(?,?,?,?,?,?);");
	    	$query-> bindValue(1,$book->getBookTitle());
	    	$query-> bindValue(2,$book->getBookAuthor());
	    	$query-> bindValue(3,$book->getBookCollection());
	    	$query-> bindValue(4,$book->getBookYear());
	    	$query-> bindValue(5,$book->getBookIsFull());
	    	$query-> bindValue(6,$book->getBookCaptions());
	    	
			/* TO DO : à supprimer si j'utilise plus la table written
			problèmatique de plusieurs auteurs pour un livre
	    	if (!($query->execute())) {return false;}
	    	
	    	//Je met le livre et son/ses auteur(s) dans ma table written

	    	//on récupère les id des book et auteurs pour les mettre dans la table written
	    	//problème: si un livre est écrit par plusieurs auteurs
	    	$id_book = getBookIdByTitle($book->getBookTitle());
	    	$query = $this->conn->prepare("INSERT INTO written VALUES(?,?);");
	    	$query-> bindValue(1,$book->getBookAuthor());
	    	$query-> bindValue(2,$book->$id_book);
			*/

	    	return $query->execute();
	    }


	    //TO DO : à supprimer si j'utilise plus la table written
		//problèmatique de plusieurs auteurs pour un livre
	    /**
	    * Méthode qui retourne l'id d'un livre en effectuant une recherche sur les titres
	    * 
	    * @param string : le titre du livre cherché
	    * @return int : l'id du livre cherché
	    */
	    /*
	    public function getBookIdByTitle ($book_title)
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
	    */

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
	    	$query = $this->conn->prepare("SELECT * FROM users WHERE mail=?;");
	    	$query-> bindValue(1,$mail);
	    	if ($query->execute()) 
	    	{
	    		echo "dans le if de la requete mail= réussie";
	    		echo "<br>";
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			echo "dans le while de getUSerByMail";
	    			$user = new User($row['id_user'], $row['mail'], $row['status'], $row['subscription_date']);
	    			$user_serialized = serialize($user);
	    		}
	    	}
	    	echo "a la fin de ma fct, user_serialized a pour valeur:";
	    	echo "<br>";
	    	echo $user_serialized;
	    	return $user_serialized;
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
	    			$author = new Author($row['id_author'], $row['name'], $row['user'], $row['$description_filename'], $row['$news_filename']);
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
	    			$book = new Book($row['id_book'], $row['title'], $row['author'], $row['$collection'], $row['$year'], $row['$is_full'],  $row['$captions_filename']);
	    			$book_serialized = serialize($book);
	    		}
	    	}
	    	return $book_serialized;
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
	    

	    /*
	    public function recupereMaTete()
	    {
	    	$query = $this->conn->prepare("SELECT * FROM ma_tete_est_partout;");
	    	//$query-> bindValue(1,$nom);
	    	$result = array();
	    	if ($query->execute()) 
	    	{
	    		$i=0;
	    		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	    			$result[$i]=$row['cokin'];
	    			$i++;
	    		}
	    	}
	    	return $result;
	    }
	    */
	}
?>