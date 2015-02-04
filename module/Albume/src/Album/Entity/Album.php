<?php

	namespace Album\Entity;
	
	use Doctrine\ORM\Mapping as ORM;
	use ZfcUser\Entity\UserInterface;
	use BjyAuthorize\Provider\Role\ProviderInterface;
	use Doctrine\Common\Collections\ArrayCollection;


	/**
	* @ORM\Entity
	* @ORM\Table(name="album")
	*/
	class Album {
		

		/**
		* @ORM\Column(name="id",type="integer")
		* @ORM\Id
		* @ORM\GeneratedValue
		*/
		private $id;


		/**
		* @ORM\Column(name="artist",type="text")
		*/
		private $artist;

		/**
		* @ORM\Column(name="title",type="text")
		*/
		private $title;

		public function setId($id){
			$this->id=$id;
		}
		public function getId(){
			return $this->id;
		}

		public function setArtist($artist){
			$this->artist=$artist;
		}
		public function getArtist(){
			return $this->artist;
		}

		public function setTitle($title){
			$this->title=$title;
		}
		public function getTitle(){
			return $this->title;
		}

		
	}
	

?>