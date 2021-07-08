<?php
declare(strict_types=1);


namespace ShopSaas\Backoffice\Auth\Application\Registrar;


use ShopSaas\Backoffice\Auth\Domain\AuthId;
use ShopSaas\Backoffice\Auth\Domain\AuthPassword;
use ShopSaas\Backoffice\Auth\Domain\AuthUsername;
use ShopSaas\Shared\Domain\Bus\Command\CommandHandler;

class RegistrarUserCommandHandler implements CommandHandler
{
    public function __construct(private UserRegistrar $registrar)
    {
    }

    public function __invoke(RegistrarUserCommand $command)
    {
        $id       = new AuthId($command->id());
        $username = new AuthUsername($command->username());
        $password = new AuthPassword($command->password());

        $this->registrar->__invoke($id, $username, $password);
    }
}
