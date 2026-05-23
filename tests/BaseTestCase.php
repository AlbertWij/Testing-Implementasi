<?php
namespace Tests;

use App\Database;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    protected \PDO $db;

    protected function setUp(): void
    {
        parent::setUp();
        $this->db = Database::connect();
        $this->db->beginTransaction();   // isolasi data antar test
    }

    protected function tearDown(): void
    {
        $this->db->rollBack();           // kembalikan DB seperti semula
        parent::tearDown();
    }
}
