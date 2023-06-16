-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-06-16 10:51:30
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
-- テーブルの構造 `アルバイト情報テーブル`
--

CREATE TABLE `アルバイト情報テーブル` (
  `バイトID` int(11) NOT NULL,
  `名前` varchar(30) DEFAULT NULL,
  `電話番号` varchar(30) DEFAULT NULL,
  `時給` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `アルバイト情報テーブル`
--

INSERT INTO `アルバイト情報テーブル` (`バイトID`, `名前`, `電話番号`, `時給`) VALUES
(1, '山田太郎', '09011111111', 1200),
(2, '田中太郎', '09022222222', 1200);

-- --------------------------------------------------------

--
-- テーブルの構造 `シフトテーブル`
--

CREATE TABLE `シフトテーブル` (
  `バイトID` int(11) DEFAULT NULL,
  `日付` date NOT NULL,
  `開始` datetime NOT NULL,
  `終了` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `シフトテーブル`
--

INSERT INTO `シフトテーブル` (`バイトID`, `日付`, `開始`, `終了`) VALUES
(1, '2023-06-16', '2023-06-16 08:00:00', '2023-06-16 14:00:00'),
(2, '2023-06-17', '2023-06-17 09:00:00', '2023-06-17 19:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `修正後シフトテーブル`
--

CREATE TABLE `修正後シフトテーブル` (
  `バイトID` int(11) DEFAULT NULL,
  `日付` date NOT NULL,
  `開始` datetime NOT NULL,
  `終了` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `修正後シフトテーブル`
--

INSERT INTO `修正後シフトテーブル` (`バイトID`, `日付`, `開始`, `終了`) VALUES
(1, '2023-06-16', '2023-06-16 10:00:00', '2023-06-16 19:00:00'),
(2, '2023-06-17', '2023-06-17 12:00:00', '2023-06-17 19:00:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `アルバイト情報テーブル`
--
ALTER TABLE `アルバイト情報テーブル`
  ADD PRIMARY KEY (`バイトID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `アルバイト情報テーブル`
--
ALTER TABLE `アルバイト情報テーブル`
  MODIFY `バイトID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
