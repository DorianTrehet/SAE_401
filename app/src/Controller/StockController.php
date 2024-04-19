<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Stocks;
use App\Entity\Stores;

/**
 * Class StockController
 * @package App\Controller
 */
class StockController
{
    /** @var mixed */
    private $entityManager;

    /** @var mixed */
    private $stockRepository;

    const API_KEY = "e8f1997c763";

    /**
     * StockController constructor.
     * @param mixed $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

/**
 * Create a new stock
 */
public function createStock()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['storeId']) && isset($_POST['productId']) && isset($_POST['quantity'])) {

        if (!isset($_POST["API_KEY"]) || $_POST['API_KEY'] !== self::API_KEY) {
            echo json_encode(["error" => "Invalid API Key"]);
            return;
        }

        $storeId = $_POST['storeId'];
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];

        $store = $this->entityManager->getRepository(Stores::class)->find($storeId);
        $product = $this->entityManager->getRepository(Products::class)->find($productId);

        // Vérification si le magasin et le produit existent
        if (!$store || !$product) {
            echo json_encode(["error" => "Store or Product not found"]);
            return;
        }

        $stock = new Stocks();
        $stock->setStore($store);
        $stock->setProduct($product);
        $stock->setQuantity($quantity);

        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        echo json_encode(["success" => "Stock created"]);
    } else {
        echo json_encode(["error" => "Stock not created"]);
    }
}

    
    /**
     * Update stock
     * @param array $params
     * @return Stocks|null
     */
    public function updateStock($params)
    {
        $stockId = $params['stockId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);

            if (!isset($_PUT["API_KEY"]) || $_PUT['API_KEY'] !== self::API_KEY) {
                echo json_encode(["error" => "Invalid API Key"]);
                return null;
            }

            $stock = $this->entityManager->getRepository(Stocks::class)->find($stockId);

            if (!$stock) {
                echo json_encode(["error" => "Stock not found"]);
                return null;
            }

            if (isset($_PUT['storeId'])) {
                $storeId = $_PUT['storeId'];
                $store = $this->entityManager->getRepository(Stores::class)->find($storeId);
                if (!$store) {
                    echo json_encode(["error" => "Store not found"]);
                    return null;
                }
            }

            if (isset($_PUT['productId'])) {
                $productId = $_PUT['productId'];
                $product = $this->entityManager->getRepository(Products::class)->find($productId);
                if (!$product) {
                    echo json_encode(["error" => "Product not found"]);
                    return null;
                }
            }

            $quantity = $_PUT['quantity'];
            $stock->setQuantity($quantity);

            $this->entityManager->flush();

            echo json_encode(['success' => 'Stock updated']);
            return $stock;
        } else {
            echo json_encode(["error" => "invalid request"]);
            return null;
        }
    }
}
