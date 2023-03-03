<?php

declare(strict_types=1);

namespace App\Packages\Infrastructures\Shared\Transaction;

use App\Packages\UseCases\Shared\Transaction\TransactionInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class Transaction implements TransactionInterface
{
    /**
     * @throws Throwable
     */
    public function begin(): void
    {
        DB::beginTransaction();
    }

    /**
     * @throws Throwable
     */
    public function rollback(): void
    {
        DB::rollBack();

        // ISOLATION LEVELをリセット
        $pdo = DB::connection()->getPdo();
        $pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL REPEATABLE READ;');
    }

    /**
     * @throws Throwable
     */
    public function commit(): void
    {
        DB::commit();

        // ISOLATION LEVELをリセット
        $pdo = DB::connection()->getPdo();
        $pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL REPEATABLE READ;');
    }
}
