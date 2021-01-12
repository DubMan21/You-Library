<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController {

    /**
     * @param BookRepository $bookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
      $this->bookRepository = $bookRepository;
    }

  /**
     * @Route("/", name="home")
     */
    public function home(){
      $books = $this->bookRepository->findLastThree();
      return $this->render('main/home.html.twig',  [
          'books' => $books
      ]);
    }
  
}