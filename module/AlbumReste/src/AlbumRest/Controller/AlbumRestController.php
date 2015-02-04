<?php

namespace AlbumRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Album\Model\Album as ModelAlbum;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import
use Zend\View\Model\JsonModel;
use Album\Entity\Album;

class AlbumRestController extends AbstractRestfulController
{
    protected $albumTable;

    private $entityManager;
  
    public function getEntityManager()
    {
     if(!$this->entityManager)
     {
      $this->entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     }
     return $this->entityManager;
    }


    public function getList()
    {
        $results = $this->getAlbumTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }

        return new JsonModel(array(
            'data' => $data,
        ));
    }

    public function get($id)
    {
        $album = $this->getAlbumTable()->getAlbum($id);

        return new JsonModel(array(
            'data' => $album,
        ));
    }

    public function create($data)
    {
        $entityManager=$this->getEntityManager();
        $album = new Album();
        $album->setId('');
        $album->setArtist($data['artist']);
        $album->setTitle($data['title']);
        $entityManager->persist($album);
        $entityManager->flush();
        die(var_dump($album));

        $id=$album->getId();        
        return $this->get($id);
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $entityManager=$this->getEntityManager();
        $album=$entityManager->getRepository('Album\Entity\Album')->find($id);
        
        die(var_dump($album));
        return $this->get($id);
    }

    public function delete($id)
    {
        $this->getAlbumTable()->deleteAlbum($id);

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}
