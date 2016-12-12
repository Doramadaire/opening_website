<?php

	/**
	* Classe représentant un auteur de livre
	*/
	class Book
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
	     * L'id de l'auteur du livre
	     *
	     * @var int
	     * @access private
	     */
		private $author;	  

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
	     * L'année de publication du livre
	     *
	     * @var int
	     * @access private
	     */
		private $year;

		/** 
	     * La propriété caractérisant si le livre est complet ou pas (donc un extrait)
	     * 2 = complet
	     * 3 = extrait
	     *
	     * @var int
	     * @access private
	     */
		private $is_full;

		/** 
	     * Le chemin vers le fichier texte qui contient les éventuelles légendes
	     *
	     * @var string
	     * @access private
	     */
		private $captions_filename;

		/**
		* Constructeur de la classe
		*
		* @return void
		*/
		function __construct($id, $title, $author, $collection, $year, $is_full, $captions_filename)
		{
			$this->id = $id;
			$this->title = $title;
			$this->author = $author;
			$this->collection = $collection;
			$this->year = $year;
			$this->is_full = $is_full;
			$this->captions_filename = $captions_filename;
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
		* Retourne l'id de l'auteur du livre
		*
		* @return int
		*/
		public function getBookAuthor()
		{
			return $this->name;
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
		public function getBookYear()
		{
			return $this->year;
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
		public function getBookCaptions()
		{
			return $this->captions_filename;
		}

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
		* Change l'auteur du livre (par son id_auteur)
		*
		* @param int
		* @return void
		*/
		public function setBookAuthor($author)
		{
			$this->$author = $author;
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
		public function setBookYear($year)
		{
			$this->$year = $year;
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
		public function setBookCaptions($captions_filename)
		{
			$this->$captions_filename = $captions_filename;
		}
	}

?>