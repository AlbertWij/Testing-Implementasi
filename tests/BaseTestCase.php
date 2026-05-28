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
        $this->db->exec('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->beginTransaction();
    }

    protected function tearDown(): void
    {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
        $this->db->exec('SET FOREIGN_KEY_CHECKS = 1');
        parent::tearDown();
    }
}