<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    /**
     *
     * @var EntityManagerInteface
     */
    private $em;

    /**
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     *
     * @var Validator
     */
    private $validator;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        parent::__construct();

        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->validator = Validation::createValidator();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp(<<<HELP
                This command allows you to create a user.

                app:create-user email password --admin
                
                The email and password argument are required.
                The admin option create an admin user instead of a regular user.
                HELP)

            // the arguments and options of the command
            ->addArgument('email', InputArgument::REQUIRED, 'The user email')
            ->addArgument('password', InputArgument::REQUIRED, 'The user plain password')           
            ->addOption('admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');
        $isAdmin = $input->getOption('admin');

        // Check if the email is valid
        $error = $this->validator->validate($email, [
            new Email()
        ]);
        if(count($error) > 0) {
            $output->writeln('Error : This email is not a valid.');
            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setRoles([$isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER']);

        // check if a user with the same email already exists.
        $existingUser = $this->userRepository->findOneBy(['email' => $email]);

        // Return an error if a user with same email already exist
        if ($existingUser) {
            $output->writeln('Error : A user is already registered with this email.');
            return Command::FAILURE;
        }

        // Encode password
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        // Insert the user in the database
        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('User has been created successfully');
        return Command::SUCCESS;
    }
}