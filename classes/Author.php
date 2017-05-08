<?php

	/**
	* Classe représentant un auteur de livre
	*/
	class Author implements JsonSerializable
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
	     * Le nom de l'auteur utilisé pour les recherches
	     *
	     * @var string
	     * @access private
	     */
		private $search_name;

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
	     * Le chemin vers le fichier pdf qui contient le CV de l'auteur
	     *
	     * @var string
	     * @access private
	     */
		private $cv_filename;

		/**
		* Constructeur de la classe
		*
		* @return void
		*/
		function __construct($id, $name, $user, $search_name, $description_filename = NULL, $cv_filename = NULL,  $news_filename = NULL)
		{
			$this->id = $id;
			$this->name = $name;
			$this->user = $user;
			$this->search_name = $search_name;
			$this->description_filename = $description_filename;
			$this->cv_filename = $cv_filename;
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
		* Retourne le search name de l'auteur
		*
		* @return string
		*/
		public function getAuthorSearchName()
		{
			return $this->search_name;
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
		* Retourne le chemin du fichier texte qui contient le CV de l'auteur
	    *
		* @return string
		*/
		public function getAuthorCV()
		{
			return $this->cv_filename;
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

		/**
		* Change le chemin du fichier texte qui contient le CV de l'auteur
	    *
		* @param string
		* @return void
		*/
		public function setAuthorCV($cv_filename)
		{
			$this->$cv_filename = $cv_filename;
		}

		/**
		* Donnes une représentation de cet auteur sous forme de string
		*
		* @param void
		*/
		public function toString()
		{
			return "Author - id=$this->id; pseudo=$this->name; associated_user_id=$this->user; description_filename=$this->description_filename; news_filename=$this->news_filename; cv_filename=$this->cv_filename";
		}

		public function toArray() 
		{
			return array(
    	    	'id' => $this->id,
				'name' => $this->name,
				'user' => $this->user,
				'description_filename' => $this->description_filename,
				'cv_filename' => $this->cv_filename,
				'news_filename' => $this->news_filename
    	    );
		}

		public function jsonSerialize () 
		{
    	    return $this->toArray();
    	}
	}

?>