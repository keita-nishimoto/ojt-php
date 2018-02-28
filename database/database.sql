-- データベース 'ojt_php' に対して 'ojt_php' というユーザー名のユーザーを '(YourPassword999)' というパスワードで作成
-- 'localhost' と '127.0.0.1' の2つを用意しているのは `-h localhost` でも `-h 127.0.0.1` でも両方繋がるようにする為
GRANT ALL ON ojt_php.* TO `ojt_php`@`127.0.0.1` IDENTIFIED BY '(YourPassword999)';
GRANT ALL ON ojt_php.* TO `ojt_php`@`localhost` IDENTIFIED BY '(YourPassword999)';

-- ユーザーの追加や権限の追加を行ったら下記の実行が必要
FLUSH PRIVILEGES;

-- 仮ユーザー登録で利用するメインテーブル
CREATE TABLE `preregisters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `is_registered` tinyint(1) NOT NULL DEFAULT '0',
  `expired_on` datetime NOT NULL,
  `lock_version` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_preregisters_01` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;
