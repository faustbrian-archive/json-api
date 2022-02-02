<?php

declare(strict_types=1);

use App\Http\Controllers\ListBlocksByDelegateController;
use App\Http\Controllers\ListBlocksController;
use App\Http\Controllers\ListCountAggregatesController;
use App\Http\Controllers\ListDelegatesByRoundController;
use App\Http\Controllers\ListDelegatesController;
use App\Http\Controllers\ListEntitiesController;
use App\Http\Controllers\ListEntityHistoryController;
use App\Http\Controllers\ListIncomingTransactionsByWalletController;
use App\Http\Controllers\ListOutgoingTransactionsByWalletController;
use App\Http\Controllers\ListRoundsController;
use App\Http\Controllers\ListTransactionFeeAggregatesController;
use App\Http\Controllers\ListTransactionsByBlockController;
use App\Http\Controllers\ListTransactionsByWalletController;
use App\Http\Controllers\ListTransactionsController;
use App\Http\Controllers\ListVotersByDelegateController;
use App\Http\Controllers\ListWalletsController;
use App\Http\Controllers\ShowBlockController;
use App\Http\Controllers\ShowDelegateController;
use App\Http\Controllers\ShowEntityController;
use App\Http\Controllers\ShowSynchronisationStateController;
use App\Http\Controllers\ShowTransactionController;
use App\Http\Controllers\ShowWalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('blocks', ListBlocksController::class)->name('blocks');
Route::get('blocks/{block}', ShowBlockController::class)->name('block');
Route::get('blocks/{block}/transactions', ListTransactionsByBlockController::class)->name('block.transactions');

Route::get('delegates', ListDelegatesController::class)->name('delegates');
Route::get('delegates/{delegate}', ShowDelegateController::class)->name('delegate');
Route::get('delegates/{delegate}/blocks', ListBlocksByDelegateController::class)->name('delegate.blocks');
Route::get('delegates/{delegate}/voters', ListVotersByDelegateController::class)->name('delegate.voters');

Route::get('entities', ListEntitiesController::class)->name('entities');
Route::get('entities/{entity}', ShowEntityController::class)->name('entity');
Route::get('entities/{entity}/history', ListEntityHistoryController::class)->name('entity.history');

Route::get('rounds', ListRoundsController::class)->name('rounds');
Route::get('rounds/{round}', ListDelegatesByRoundController::class)->name('round');

Route::get('state/synchronisation', ShowSynchronisationStateController::class)->name('state.synchronisation');

Route::get('transactions', ListTransactionsController::class)->name('transactions');
Route::get('transactions/{transaction}', ShowTransactionController::class)->name('transaction');

Route::get('wallets', ListWalletsController::class)->name('wallets');
Route::get('wallets/{wallet}', ShowWalletController::class)->name('wallet');
Route::get('wallets/{wallet}/transactions', ListTransactionsByWalletController::class)->name('wallet.transactions');
Route::get('wallets/{wallet}/transactions/incoming', ListIncomingTransactionsByWalletController::class)->name('wallet.transactions.incoming');
Route::get('wallets/{wallet}/transactions/outgoing', ListOutgoingTransactionsByWalletController::class)->name('wallet.transactions.outgoing');

Route::get('statistics/counts', ListCountAggregatesController::class)->name('statistics.counts');
Route::get('statistics/fees', ListTransactionFeeAggregatesController::class)->name('statistics.fees');
