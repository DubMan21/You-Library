<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookSearch;
use App\Form\BookSearchType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController {

    /**
     * @param BookRepository $bookRepository
     */
    private $bookRepository;

    /**
     * @param EntityManagerInterface $em
     */
    private $em;

    public function __construct(BookRepository $bookRepository, EntityManagerInterface $em)
    {
      $this->bookRepository = $bookRepository;
      $this->em = $em;
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
     * @Route("/books", name="books")
     */
    public function books(Request $request){
      $bookSearch = new BookSearch();
      $form = $this->createForm(BookSearchType::class, $bookSearch);
      $form->handleRequest($request);

      $offset = max(0, $request->query->getInt('offset', 0));
      $paginator = $this->bookRepository->getBookPaginator($bookSearch, $offset);

      return $this->render('main/books.html.twig',  [
        'books' => $paginator,
        'previous' => $offset - BookRepository::PAGINATOR_PER_PAGE,
        'next' => min(count($paginator), $offset + BookRepository::PAGINATOR_PER_PAGE),
        'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/like/{id}", name="like")
     */
    public function like(Book $book, Request $request){
      $user = $this->getUser();
      $user->addLike($book);
      $this->em->flush();
      return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/unlike/{id}", name="unlike")
     */
    public function unlike(Book $book, Request $request){
      $user = $this->getUser();
      $user->removeLike($book);
      $this->em->flush();
      return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("likes", name="likes")
     */
    public function likes(){
      $books = $this->getUser()->getLikes();
      return $this->render('main/likes.html.twig', [
        'books' => $books
      ]);
    }
  
}