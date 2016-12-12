<?php

	/**
	* Classe représentant un auteur de livre
	*/
	class Author
	{
		/** 
	     * Id unique de l'auteur
	     *
	     * @var int
	     * @access private
	     */
	    private $id;

	    /** 
	     * Le nom de l'auteur
	     *
	     * @var string
	     * @access private
	     */
		private $name;

	    /** 
	     * Le compte utilisateur du site que posséde l'auteur
	     *
	     * @var int
	     * @access private
	     */
		private $user;

		/** 
	     * Le chemin vers le fichier texte qui contient la description de l'auteur
	     *
	     * @var string
	     * @access private
	     */
		private $description_filename;

		/** 
	     * Le chemin vers le fichier texte qui contient les actualités de l'auteur
	     *
	     * @var string
	     * @access private
	     */
		private $news_filename;

		/**
		* Constructeur de la classe
		*
		* @return void
		*/
		function __construct($id, $name, $user, $description_filename, $news_filename)
		{
			$this->id = $id;
			$this->name = $name;
			$this->user = $user;			
			$this->description_filename = $description_filename;
			$this->news_filename = $news_filename;
		}

		/**
		* Retourne la valeur de l'id de l'auteur
		*
		* @return int
		*/
		public function getAuthorID()
		{
			return $this->id;
		}

		/**
		* Retourne le nom de l'auteur
		*
		* @return string
		*/
		public function getAuthorName()
		{
			return $this->name;
		}

		/**
		* Retourne l'id du compte utilisateur de l'auteur
		*
		* @return int
		*/
		public function getAuthorAccount()
		{
			return $this->user;
		}

		/**
		* Retourne le chemin du fichier texte qui contient la description de l'auteur
		*
		* @return string
		*/
		public function getAuthorDescription()
		{
			return $this->description_filename;
		}

		/**
		* Retourne le chemin du fichier texte qui contient les actualités de l'auteur
		*
		* @return string
		*/
		public function getAuthorNews()
		{
			return $this->news_filename;
		}

		/**
		* Change l'id du compte utilisateur de l'auteur
		*
		* @param int
		* @return void
		*/
		public function setAuthorAccount($id_user)
		{
			$this->$user = $id_user;
		}

		/**
		* Change le nom de l'auteur
		*
		* @param string
		* @return void
		*/
		public function setAuthorName($name)
		{
			$this->$name = $name;
		}

		/**
		* Change le chemin du fichier texte qui contient la description de l'auteur
		*
		* @param string
		* @return void
		*/
		public function setAuthorDescription($description_filename)
		{
			$this->$description_filename = $description_filename;
		}

		/**
		* Change le chemin du fichier texte qui contient les actualités de l'auteur
		*
		* @param string
		* @return void
		*/
		public function setAuthorNews($news_filename)
		{
			$this->$news_filename = $news_filename;
		}
	}

?>