-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-06-16 11:14:02
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mydb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `arubaito_table`
--

CREATE TABLE `arubaito_table` (
  `バイトID` int(11) NOT NULL,
  `名前` varchar(30) DEFAULT NULL,
  `電話番号` varchar(30) DEFAULT NULL,
  `時給` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `arubaito_table`
--

INSERT INTO `arubaito_table` (`バイトID`, `名前`, `電話番号`, `時給`) VALUES
(1, '山田太郎', '09011111111', 1200),
(2, '田中太郎', '09022222222', 1200);

-- --------------------------------------------------------

--
-- テーブルの構造 `revised sihuto_table`
--

CREATE TABLE `revised sihuto_table` (
  `バイトID` int(11) DEFAULT NULL,
  `日付` date NOT NULL,
  `開始` datetime NOT NULL,
  `終了` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `revised sihuto_table`
--

INSERT INTO `revised sihuto_table` (`バイトID`, `日付`, `開始`, `終了`) VALUES
(1, '2023-06-16', '2023-06-16 10:00:00', '2023-06-16 19:00:00'),
(2, '2023-06-17', '2023-06-17 12:00:00', '2023-06-17 19:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `sihuto_table`
--

CREATE TABLE `sihuto_table` (
  `バイトID` int(11) DEFAULT NULL,
  `日付` date NOT NULL,
  `開始` datetime NOT NULL,
  `終了` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `sihuto_table`
--

INSERT INTO `sihuto_table` (`バイトID`, `日付`, `開始`, `終了`) VALUES
(1, '2023-06-16', '2023-06-16 08:00:00', '2023-06-16 14:00:00'),
(2, '2023-06-17', '2023-06-17 09:00:00', '2023-06-17 19:00:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `arubaito_table`
--
ALTER TABLE `arubaito_table`
  ADD PRIMARY KEY (`バイトID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `arubaito_table`
--
ALTER TABLE `arubaito_table`
  MODIFY `バイトID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
