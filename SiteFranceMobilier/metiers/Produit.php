<?php
	class Produit
	{
		private $pro_id;
		private $pro_reference;
		private $pro_designation;
		private $pro_prixTTC;
		private $pro_photo;
		public function __construct($id,$reference,$designation,$prixTTC,$photo)
		{
			$this->pro_id=$id;
			$this->pro_reference=$reference;
			$this->pro_designation=$designation;
			$this->pro_prixTTC=$prixTTC;
			$this->pro_photo=$photo;
		}
		public function GetId()
		{
			return $this->pro_id;
		}
		public function GetReference()
		{
			return $this->pro_reference;
		}
		public function GetDesignation()
		{
			return $this->pro_designation;
		}
		public function GetPrixTTC()
		{
			return $this->pro_prixTTC;
		}
		public function GetPhoto()
		{
			return $this->pro_photo;
		}
	}
?>