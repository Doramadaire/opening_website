<?php

	/**
	* Classe représentant un auteur de livre
	*/
	class Book implements JsonSerializable
	{
		/** 
	     * Id unique du livre
	     *
	     * @var int
	     * @access private
	     */
	    private $id;

	    /** 
	     * Le titre du livre
	     *
	     * @var string
	     * @access private
	     */
		private $title;

		/** 
	     * Le nom du fichier du book sur le serveur
	     * Dans le dossier /assets/book pour la version compléte
	     * Et dans le dossier /assets/books_extraits pour les extraits
	     *
	     * @var string /assets/extracts
	     * @access private
	     */
		private $filename;

	    /** 
	     * Une array contenant les ids du/des auteur(s) du livre
	     *
	     * @var array[int]
	     * @access private
	     */
		private $authors;	  

		/** 
	     * La collection à laquelle appartient le livre
	     * Il existe 2 collections : 
	     *      -book
	     *      -book_photo
	     *
	     * @var string
	     * @access private
	     */
		private $collection;

		/** 
	     * La date de publication du livre
	     *
	     * @var date
	     * @access private
	     */
		private $publish_date;

		/** 
	     * Un array sérialisé contenant les id d'accès privilégiés à ce book
	     *
	     * @var array(string)
	     * @access private
	     */
		private $token_container;

		/** 
	     * Le chemin vers le fichier texte qui contient les éventuelles légendes
	     *
	     * @var string
	     * @access private
	     */
		//private $captions_filename;

		/**
		* Constructeur de la classe
		*
		* @return void
		*/
		function __construct($id, $title, $filename, $authors, $collection, $publish_date, $token_container = NULL)
		{
			$this->id = $id;
			$this->title = $title;
			$this->filename = $filename;
			$this->authors = $authors;//Un array contenant les ids du/des auteur(s) du livre
			$this->collection = $collection;
			$this->publish_date = $publish_date;
			//Un array contenant des tokens
			$this->token_container = $token_container != NULL ? $token_container : array();
		}

		/**
		* Supprime les tokens expirés de la base de données
		*
		* @return void
		*/
		public function cleanOldTokens()
		{
			$clean_token_container = array();
			foreach ($this->token_container as $tokenc) {
				//chaque tokenc est un array avec
				//un token en position 0
				//sa date de création en position 1
				//le token expire après 28jours (en secondes)
				if ($tokenc[1] > time() - (28*24*60*60)) {
					//on garde ce token
					$clean_token_container[] = $tokenc;
				}
			}
			//mise à jour de la base de données
			$sql = SQL::getInstance();
  			$conn = $sql->getBoolConnexion();

  			if ($sql->setBookAccessTokens($this, $clean_token_container)) {
  				$this->token_container = $clean_token_container;
  			}
		}

		/**
		* Retourne la valeur de l'id du livre
		*
		* @return int
		*/
		public function getBookID()
		{
			return $this->id;
		}

		/**
		* Retourne le titre du livre
		*
		* @return string
		*/
		public function getBookTitle()
		{
			return $this->title;
		}

		/**
		* Retourne le nom du fichier du book sur le serveur
		*
		* @return string
		*/
		public function getBookFilename()
		{
			return $this->filename;
		}

		/**
		* Retourne l'array contenant le(s) id(s) de(s) l'auteur(s) du livre
		*
		* @return array[int]
		*/
		public function getBookAuthors()
		{
			return $this->authors;
		}

		/**
		* Retourne la collection à laquelle le livre appartient
		*
		* @return string
		*/
		public function getBookCollection()
		{
			return $this->collection;
		}

		/**
		* Retourne l'année de publication du livre
		*
		* @return int
		*/
		public function getBookPublishDate()
		{
			return $this->publish_date;
		}

		/**
		* Retourne les access tokens
		*
		* @return array(string)
		*/
		public function getAcessTokens()
		{
			return $this->token_container;
		}


		/**
		* Retourne la propriété caractérisant si le livre est complet ou pas (donc un extrait)
	    * 2 = complet
	    * 3 = extrait
		*
		* @return int
		*/
		public function getBookIsFull()
		{
			return $this->is_full;
		}

		/**
		* Retourne le chemin du fichier texte qui contient les légendes du livre
		*
		* @return string
		*/
		/*public function getBookCaptions()
		{
			return $this->captions_filename;
		}*/

		/**
		* Change le titre du livre
		*
		* @param string
		* @return void
		*/
		public function setBookTitle($title)
		{
			$this->$title = $title;
		}

		/**
		* Change le nom du fichier du book sur le serveur
		*
		* @param string
		* @return void
		*/
		public function setBookFilename($filename)
		{
			$this->$filename = $filename;
		}

		/**
		* Change l'auteur du livre (par son id_auteur)
		*
		* @param int
		* @return void
		*/
		public function setBookAuthors($authors)
		{
			$this->$authors = $authors;
		}

		/**
		* Change la collection à laquelle le livre appartient
		*
		* @param string
		* @return void
		*/
		public function setBookCollection($collection)
		{
			$this->$collection = $collection;
		}

		/**
		* Change l'année de publication du livre
		*
		* @param int
		* @return void
		*/
		public function setBookPublishDate($publish_date)
		{
			$this->$publish_date = $publish_date;
		}

		/**
		* Change la propriété is_full du livre
		*
		* @param int
		* @return void
		*/
		public function setBookIsFull($is_full)
		{
			$this->$is_full = $is_full;
		}

		/**
		* Change le chemin du fichier texte qui contient les légendes du livre
		*
		* @param string
		* @return void
		*/
		/*public function setBookCaptions($captions_filename)
		{
			$this->$captions_filename = $captions_filename;
		}*/

		/**
		* Ajoute un token container contenant un token créé à la date actuelle
		*
		* @param string
		* @return boolean success
		*/
		public function addAccessToken($token)
		{
			$success = false;
			$token_creationdate = time();

			$sql = SQL::getInstance();
  			$conn = $sql->getBoolConnexion();

  			$new_token_container = $this->token_container;
  			$new_token_container[] = array($token, $token_creationdate);

  			if ($sql->setBookAccessTokens($this, $new_token_container)) {
  				$this->token_container = $new_token_container;
  				$success = true;
  			}
  			return $success;
		}

		public function toArray() 
		{
			return array(
    	    	'id' => $this->id,
				'title' => $this->title,
				'filename' => $this->filename,
				'authors' => $this->authors,
				'collection' => $this->collection,
				'publish_date' => $this->publish_date,
				'token_container' => $this->token_container
    	    );
		}

		public function jsonSerialize () 
		{
    	    return $this->toArray();
    	}
	}

?>