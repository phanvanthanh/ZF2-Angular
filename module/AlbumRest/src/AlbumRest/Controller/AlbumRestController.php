<?php

namespace AlbumRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
    
use Zend\View\Model\JsonModel;
use Album\Entity\Album;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

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
        $entityManager=$this->getEntityManager();
        $results=$entityManager->getRepository('Album\Entity\Album')->findAll();

        $data = array();
        foreach($results as $result) {
            $hydrator = new DoctrineHydrator($entityManager);
            $dataArray = $hydrator->extract($result); // chuyển từ đối tượng sang mảng
            $data[] = $dataArray;
        }
        //die(var_dump($data));
        return new JsonModel(array(
            'data' => $data,
        ));
    }

    public function get($id)
    {
        $entityManager=$this->getEntityManager();
        $result=$entityManager->getRepository('Album\Entity\Album')->find($id);
        $hydrator = new DoctrineHydrator($entityManager);        
        $album=$hydrator->extract($result);// chuyển từ đối tượng sang mảng
        return new JsonModel(array(
            'data' => $album,
        ));
    }

    public function create($data)
    {
        $entityManager=$this->getEntityManager();
        $hydrator = new DoctrineHydrator($entityManager);
        $album = new Album();
        $album = $hydrator->hydrate($data, $album); // chuyển mảng $data thành đối tượng album
        
        //lưu album
        $entityManager->persist($album);
        $entityManager->flush();

        $id=$album->getId();        
        return $this->get($id);
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $entityManager=$this->getEntityManager();
        $album=$entityManager->getRepository('Album\Entity\Album')->find($id);
        
        return $this->get($id);
    }

    public function delete($id)
    {
        $entityManager=$this->getEntityManager();
        $album=$entityManager->getRepository('Album\Entity\Album')->find($id);
        $entityManager->remove($album);
        $entityManager->flush();

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }
}
