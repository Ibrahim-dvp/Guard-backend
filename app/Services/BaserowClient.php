<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaserowClient
{
  protected $baseUrl;
  protected $token;
  protected $databaseId;
  protected $tableIds;

  public function __construct()
  {
    $this->baseUrl = config('services.baserow.base_url');
    $this->token = config('services.baserow.token');
    $this->databaseId = config('services.baserow.database_id');
    $this->tableIds = config('services.baserow.table_ids');
  }

  protected function request($method, $endpoint, $data = [])
  {
    $response = Http::withHeaders([
      'Authorization' => 'Token ' . $this->token,
      'Content-Type' => 'application/json',
    ])->$method("{$this->baseUrl}/api/{$endpoint}/", $data);

    $response->throw();

    return $response->json();
  }

  public function getTableId(string $tableName): ?int
  {
    return $this->tableIds[$tableName] ?? null;
  }

  public function listRows(string $tableName, array $query = [])
  {
    $tableId = $this->getTableId($tableName);
    if (!$tableId) {
      throw new \Exception("Baserow table '{$tableName}' not found in configuration.");
    }
    return $this->request('get', "database/rows/table/{$tableId}", $query);
  }

  public function createRow(string $tableName, array $data)
  {
    $tableId = $this->getTableId($tableName);
    if (!$tableId) {
      throw new \Exception("Baserow table '{$tableName}' not found in configuration.");
    }
    return $this->request('post', "database/rows/table/{$tableId}/", $data);
  }

  public function updateRow(string $tableName, int $rowId, array $data)
  {
    $tableId = $this->getTableId($tableName);
    if (!$tableId) {
      throw new \Exception("Baserow table '{$tableName}' not found in configuration.");
    }
    return $this->request('patch', "database/rows/table/{$tableId}/{$rowId}/", $data);
  }

  public function deleteRow(string $tableName, int $rowId)
  {
    $tableId = $this->getTableId($tableName);
    if (!$tableId) {
      throw new \Exception("Baserow table '{$tableName}' not found in configuration.");
    }
    return $this->request('delete', "database/rows/table/{$tableId}/{$rowId}/");
  }

  // You can add more methods here as needed, e.g., getSingleRow, batchUpdate, etc.
}
