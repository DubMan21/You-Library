<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/movies", name="movies")
     */
    public function movies(Request $request){
      $offset = max(0, $request->query->getInt('offset', 0));
      $paginator = $this->bookRepository->getBookPaginator($offset);

      return $this->render('main/list.html.twig',  [
        'books' => $paginator,
        'previous' => $offset - BookRepository::PAGINATOR_PER_PAGE,
        'next' => min(count($paginator), $offset + BookRepository::PAGINATOR_PER_PAGE),
      ]);
    }
  
}