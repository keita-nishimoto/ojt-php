<?php
/**
 * PreregistrationRepository
 */

namespace App\Models\Repository;

use App\Models\Domain\Preregistration\Preregistration;
use App\Models\Domain\Preregistration\PreregistrationBuilder;
use App\Models\Domain\Preregistration\PreregistrationValue;

/**
 * Class PreregistrationRepository
 *
 * @package App\Models\Repository
 */
class PreregistrationRepository extends Repository
{
    /**
     * PreregistrationRepository constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * トークンを作成する
     *
     * @param PreregistrationValue $preregistrationValue
     * @return Preregistration
     */
    public function createToken(PreregistrationValue $preregistrationValue): Preregistration
    {
        $preregistrationId = $this->savePreregistrations();

        $this->savePreregistrationsTokens($preregistrationValue, $preregistrationId);

        $this->savePreregistrationsEmails($preregistrationValue, $preregistrationId);

        $preregistrationBuilder = new PreregistrationBuilder();

        $preregistrationBuilder->setId($preregistrationId);
        $preregistrationBuilder->setIsRegistered(false);
        $preregistrationBuilder->setToken($preregistrationValue->getToken());
        $preregistrationBuilder->setExpiredOn($preregistrationValue->getExpiredOn());
        $preregistrationBuilder->setEmail($preregistrationValue->getEmail());
        $preregistrationBuilder->setLockVersion(0);

        return $preregistrationBuilder->build();
    }

    /**
     * preregistrations テーブルにデータを保存する
     *
     * @return int
     */
    private function savePreregistrations(): int
    {
        $sql = '
          INSERT INTO
              preregistrations (is_registered)
          VALUES
              (0)
        ';

        $statement = $this->getPdo()->prepare($sql);

        $statement->execute();

        return intval($this->getPdo()->lastInsertId());
    }

    /**
     * preregistrations_tokens テーブルにデータを保存する
     *
     * @param PreregistrationValue $preregistrationValue
     * @param int $preregistrationId
     */
    private function savePreregistrationsTokens(
        PreregistrationValue $preregistrationValue,
        int $preregistrationId
    ): void {
        $sql = '
          INSERT INTO
              preregistrations_tokens (register_id, token, expired_on)
          VALUES
              (:register_id, :token, :expired_on)
        ';

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(':register_id', $preregistrationId);
        $statement->bindValue(':token', $preregistrationValue->getToken());
        $statement->bindValue(
            ':expired_on',
            $preregistrationValue->getExpiredOn()->format('Y-m-d H:i:s')
        );

        $statement->execute();
    }

    /**
     * preregistrations_emails テーブルにデータを保存する
     *
     * @param PreregistrationValue $preregistrationValue
     * @param int $preregistrationId
     */
    private function savePreregistrationsEmails(
        PreregistrationValue $preregistrationValue,
        int $preregistrationId
    ): void {
        $sql = '
            INSERT INTO
                preregistrations_emails (register_id, email)
            VALUES
                (:register_id, :email)
        ';

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(':register_id', $preregistrationId);
        $statement->bindValue(':email', $preregistrationValue->getEmail());

        $statement->execute();
    }
}
