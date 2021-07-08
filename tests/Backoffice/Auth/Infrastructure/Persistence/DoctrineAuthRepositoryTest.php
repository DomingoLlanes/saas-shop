<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Backoffice\Auth\Infrastructure\Persistence;

use ShopSaas\Tests\Backoffice\Auth\BackofficeAuthModuleInfrastructureTestCase;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUserMother;
use ShopSaas\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class DoctrineAuthRepositoryTest extends BackofficeAuthModuleInfrastructureTestCase
{
    /** @test */
    public function it_should_save_a_valid_user(): void
    {
        $this->mySqlRepository()->save(AuthUserMother::create());
    }

    /** @test */
    public function it_should_search_one_existing_user(): void
    {
        $existingAuthUser = AuthUserMother::create();

        $this->mySqlRepository()->save($existingAuthUser);
        $this->clearUnitOfWork();

        $this->assertSimilar($existingAuthUser, $this->mySqlRepository()->search($existingAuthUser->username()));
    }

    /** @test */
    public function it_should_not_return_a_non_existing_user(): void
    {
        $this->assertNull($this->mySqlRepository()->search(AuthUsernameMother::create()));
    }
}
