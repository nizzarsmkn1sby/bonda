<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Helper function to check if index exists
        $indexExists = function($table, $indexName) {
            $indexes = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
            return count($indexes) > 0;
        };

        // Products table indexes
        Schema::table('products', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('products', 'products_name_index')) {
                $table->index('name');
            }
            if (!$indexExists('products', 'products_sku_index')) {
                $table->index('sku');
            }
            if (!$indexExists('products', 'products_barcode_index')) {
                $table->index('barcode');
            }
            if (!$indexExists('products', 'products_category_id_index')) {
                $table->index('category_id');
            }
            if (!$indexExists('products', 'products_is_active_index')) {
                $table->index('is_active');
            }
            if (!$indexExists('products', 'products_is_active_stock_quantity_index')) {
                $table->index(['is_active', 'stock_quantity']);
            }
        });

        // Transactions table indexes
        Schema::table('transactions', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('transactions', 'transactions_user_id_index')) {
                $table->index('user_id');
            }
            if (!$indexExists('transactions', 'transactions_transaction_date_index')) {
                $table->index('transaction_date');
            }
            if (!$indexExists('transactions', 'transactions_payment_status_index')) {
                $table->index('payment_status');
            }
            if (!$indexExists('transactions', 'transactions_user_id_transaction_date_index')) {
                $table->index(['user_id', 'transaction_date']);
            }
        });

        // Transaction details table indexes
        Schema::table('transaction_details', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('transaction_details', 'transaction_details_transaction_id_index')) {
                $table->index('transaction_id');
            }
            if (!$indexExists('transaction_details', 'transaction_details_product_id_index')) {
                $table->index('product_id');
            }
        });

        // Restocks table indexes
        Schema::table('restocks', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('restocks', 'restocks_product_id_index')) {
                $table->index('product_id');
            }
            if (!$indexExists('restocks', 'restocks_user_id_index')) {
                $table->index('user_id');
            }
            if (!$indexExists('restocks', 'restocks_restock_date_index')) {
                $table->index('restock_date');
            }
        });

        // Categories table indexes
        Schema::table('categories', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('categories', 'categories_name_index')) {
                $table->index('name');
            }
            if (!$indexExists('categories', 'categories_is_active_index')) {
                $table->index('is_active');
            }
        });

        // Users table indexes
        Schema::table('users', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('users', 'users_email_index')) {
                $table->index('email');
            }
            if (!$indexExists('users', 'users_role_id_index')) {
                $table->index('role_id');
            }
            if (!$indexExists('users', 'users_is_active_index')) {
                $table->index('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Helper function to check if index exists
        $indexExists = function($table, $indexName) {
            $indexes = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
            return count($indexes) > 0;
        };

        // Products table
        Schema::table('products', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('products', 'products_name_index')) {
                $table->dropIndex(['name']);
            }
            if ($indexExists('products', 'products_sku_index')) {
                $table->dropIndex(['sku']);
            }
            if ($indexExists('products', 'products_barcode_index')) {
                $table->dropIndex(['barcode']);
            }
            if ($indexExists('products', 'products_category_id_index')) {
                $table->dropIndex(['category_id']);
            }
            if ($indexExists('products', 'products_is_active_index')) {
                $table->dropIndex(['is_active']);
            }
            if ($indexExists('products', 'products_is_active_stock_quantity_index')) {
                $table->dropIndex(['is_active', 'stock_quantity']);
            }
        });

        // Transactions table
        Schema::table('transactions', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('transactions', 'transactions_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($indexExists('transactions', 'transactions_transaction_date_index')) {
                $table->dropIndex(['transaction_date']);
            }
            if ($indexExists('transactions', 'transactions_payment_status_index')) {
                $table->dropIndex(['payment_status']);
            }
            if ($indexExists('transactions', 'transactions_user_id_transaction_date_index')) {
                $table->dropIndex(['user_id', 'transaction_date']);
            }
        });

        // Transaction details table
        Schema::table('transaction_details', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('transaction_details', 'transaction_details_transaction_id_index')) {
                $table->dropIndex(['transaction_id']);
            }
            if ($indexExists('transaction_details', 'transaction_details_product_id_index')) {
                $table->dropIndex(['product_id']);
            }
        });

        // Restocks table
        Schema::table('restocks', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('restocks', 'restocks_product_id_index')) {
                $table->dropIndex(['product_id']);
            }
            if ($indexExists('restocks', 'restocks_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($indexExists('restocks', 'restocks_restock_date_index')) {
                $table->dropIndex(['restock_date']);
            }
        });

        // Categories table
        Schema::table('categories', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('categories', 'categories_name_index')) {
                $table->dropIndex(['name']);
            }
            if ($indexExists('categories', 'categories_is_active_index')) {
                $table->dropIndex(['is_active']);
            }
        });

        // Users table
        Schema::table('users', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('users', 'users_email_index')) {
                $table->dropIndex(['email']);
            }
            if ($indexExists('users', 'users_role_id_index')) {
                $table->dropIndex(['role_id']);
            }
            if ($indexExists('users', 'users_is_active_index')) {
                $table->dropIndex(['is_active']);
            }
        });
    }
};
