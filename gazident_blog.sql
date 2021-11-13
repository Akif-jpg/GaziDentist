-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2021 at 01:12 AM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gazident_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'no_category.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_image`) VALUES
(17, 'Diş Hekimliği', 'no_category.png'),
(18, 'Endodonti', 'no_category.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_email` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_reply` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_reply_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_status` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `friend_ls` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `friend_request` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT 'System',
  `received_request` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT 'System'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `username`, `friend_ls`, `friend_request`, `received_request`) VALUES
(1, 'Akif', NULL, 'System,BeroBaba,Benan', 'System,BeroBaba,Benan,Dalong'),
(2, 'Benan', NULL, 'System,Akif', 'System,BeroBaba,Akif'),
(3, 'BeroBaba', NULL, 'System,Benan,Akif', 'System,Akif'),
(4, 'Dalong', NULL, 'System,Akif', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `msg_id` int(10) NOT NULL,
  `msg_status` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Panding',
  `msg_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_author` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_subject` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `author_email` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`msg_id`, `msg_status`, `msg_date`, `msg_author`, `msg_subject`, `author_email`, `msg_content`) VALUES
(18, 'replied', '2021-09-21 01:16:28 AM', 'Deneme', 'Deneme', 'akifesadi193@gmail.com', 'Deneme amaÃ§lÄ± atÄ±lmÄ±ÅŸtÄ±r'),
(19, 'replied', '2021-10-16 11:43:27 PM', 'Da', 'BaÅŸarÄ±lar', 'husoerdog@yandex.com', 'Sitenizi Ã§ok beÄŸendim, baÅŸarÄ±larÄ±nÄ±zÄ±n devamÄ±nÄ± dilerim');

-- --------------------------------------------------------

--
-- Table structure for table `message_rooms`
--

CREATE TABLE `message_rooms` (
  `id` int(11) NOT NULL,
  `room_title` varchar(200) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_participiants` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_password` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_owner_username` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `messages` longtext COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `message_rooms`
--

INSERT INTO `message_rooms` (`id`, `room_title`, `room_participiants`, `room_password`, `room_owner_username`, `messages`) VALUES
(58, 'Demo Oda', 'Akif', 'p91iicpoikim', 'Akif', 'eyJpdiI6Im5TSWg1M3RHd0JydG5qUjZKbXZCcWc9PSIsInZhbHVlIjoieE1vVzE5TEZGRUc5WklWQ0ZRbDdRbzVseDNpVzFOanlRYWpYSXIvMXJYWnhHdWhLc1BwczN1Z2lFMFZHdkRXYURHbmdXallwS1Q2R0hUd0dnMW5HZmpWbjR6RGtaSlVKMy9XVFdWaVVpV0FIbGJzLzdHWVhjM3lzcm1OM3hrZDlaM3NtZXBFWm9UdFpFSXpkcWZVbzRWbzJFQTJicVpKbVl2MGlRWmM1WGZhOFhLWEtSUi93UjJkLzBQeStlYjY2bUhGUGhsOGtETHcwSXo1QnFBYW5OZ1MwWFVINDJKeWhUdFBqQUVOdjdRRT0iLCJtYWMiOiI4YTUyYWI2OWFkMDBmODcyODgwM2JmZmRiYWM2MTU4YmIwZDUzZTI1NmNiZWY4MzMyZDYxOTAxMDRhMzIzYjZlIiwidGFnIjoiIn0='),
(59, 'Demo Oda2', 'Akif', 'gv1yf8ig397e', 'Akif', 'eyJpdiI6IjRiaVVPbDYrb2pEMnBBTUdQZnZnREE9PSIsInZhbHVlIjoib0JzdmI3RnR2eURBVzFFVTQyVDdTM0huMWxtU2kxd2VreWRvMjhYMHQ0MjVtaVYwU25IU25SbTN1T1AzMXNKaHo1SFNPNHVpWE1uUU5tbzB1S3pzYlJBdmRCUloreTljL3hmSDhMNXNPYmFEQ3BnVXExZHIwaGxCaUMyeEp5QkU0U2VKb280U3gzYmE4alkxN3VIV1lXSkNvUll4SGZnOWJEK1dyRWd0ZFlrdG9qTlU5ZDVrRjd5SWVua1JVRWtNVUNUSjVpcTA0RWFPOVBWOHNyZU00L292anlxQ0toVEtpbU1IL0ZZVVZic0NOQ29FQTNVRXhudVhvUzRrTEY3Rm1TWmRnQ1gwUlg4Yzk2MmR0c3lEWm9QK0wvanROb2hwSy80VU5jVGxmQTVGdXNKWjQreWQyaWZ2TXdwQjZTZXFrLzBWdWVoWWhUV0Q5N28xMWZNbWdoMjd1a0dpd0RqNTIyVlQvTktkSUdyQnVyVmlFdURTN0RVWWc2UEFBaVNQU1pnQlNtaWN3bEJaaEVhbmE5dGtPeFhFMk1iYnJiekwvVFJCSm9wWVdvYy9RNkxiUEs2Q2REeVZuamRPanhPU2RmK1crN3FGaVRCb0ZYcHplZ0puY0E4U25UbUJuVVJ6VTJianVoWlFkZER4MSthai9FUFBSU1E1UWVON0pCTjNXR3JmM3FkSjFhMkJrNWhOTXhDZ1lyLzJUNjl1Rjl6RFh2ZnhUVzVMUUF3SFgyVkV0WW5ZZWtwYmlmUndLV0k0K1FLQmFteWZHQWEwQ012cVNHSTZaSjE0ZVRPYThaalJEblA2ZHN3RCtLVHFHTmpDRTJySkVEV3g3K3g1Z3FyTzhtVWFaN0g0SVdFKzBsU0dTbVB1cElJcXN4RGVkNU96Q3pkcnNBMGFpbFdPcHdpbVRmeFpoVFlsNlJ5ek9uTVlaOERZa2tXdWRpb1ZGSGdNeWR5b3Zncis0N0h1aENNdk9EYmRhWWZITS9mRXBRd3pjR2I0K0Q0aXlYVGZIelg0aXJtaWF6Vk5VU2dGRTJycHkybGgraGpUWWtGQ2tFVTZ3S1lYWld4M1VwQ002UXVzdjllTjJPYjAzZElaZGpEUW1OSmkzNld6dkhLTmEvbFc1QzlLNjBjaU5OcjROUlhGbWErT1FUMElacUlOdktkM25UaUF2ZDdoOFc0NDlMOU5HeU1FSzN0VlZQelNoTmZ0Y3lYRW8wUVhVaDRHdUd6dFBTZkEwVTN5Zk9XR0c1RXBnSXJnaUdGYmR6am9VQ3VTcitYNnV4VzROTTltdm1kN2dmeVRNSzVYZzhxOXdhZVBCQVRpREZKeGxtaEt2cnYwM2FQVWJEcWZyUDlmR1I1Wk1FTUhIYXhNb005NGFvVzZFQmswVFA5OWlaRXNOVXlUS090TE00Z0RjNm9Wd3lVL20zeFJqdzQ1cmZDS3pQOGh5V3J2ZjZUa2JlLzFXeGExTzhPU0pJR1VEenAxcGtNUWtjSzFOVHlJNFFjTUFNaC9KcjF0aXFobVliZ0RaSWJlWGJSV2xjTWtEeFFydXVMRW13V3M3clVJUzdWdjlBVzY1NHdnb1V4Sk9JTkhvZC8rTnh0dHp4dzVxSUZ5cG1tK043Z2htazVRbE9BWWJkOWVabmZiK2lkS0hiMmdnQTN6ZGJEZUZYREY2eTlyWlBlSHo1SDJBcnIvTWVDUytFSk1SZnNjcEVLWjErZnl2RTJGM0hxVms5d1g0NWNRbHJxR2V3MDhveDI3SDJ5MjJwem0wc2RiSCszMUNsbGR4QXhmZjNXTDg1c1hKNDBoS3ZlTm91MldZT280R3podUsxT2Q2NVRobU9SNWZySmtCRTBEay8xNVJiSTlnVzNLbFFLZlRzMGQwc3VMVGFvTFVyOCtnR3ZxUUJXNmgrMndUZnZBMk9HVWJua250Nzk3S25aOW52d1JkUkRjWW8xREdiUHNXZHp0WTZlVnpobU5yMG1BOU1uT2wrVHcyaXdjeER5eWtHSHdhaWY1MFQvR1Y1dklqRmdlZHZ1eVNIWW96TFZSNzZCSWZXQ3BPa1ZMRWVnRWk2SElYc0tWcUFsZjZFSkRCYVkzKzBYMEw5SzNGNE5EeVQvSy9ObWZEcmtNLzcwN3ViTlNUczk4MUp6dko5aTc3QkcycUZwOVVmWFhHcHM1ZlBXZTBzRW92RzBTVm5nZkRvKy9HQmVNblpIMGNjWXNjYUxpYnpvczlHY2VCQlZ6M0VUcEIzMlBBU1FyRkZoYjJnQTZVeUk2T2djSGc5aGxweEd1N1o1L1ZrT0tqdzRyc0RicHkzYTkrTDVOTGRNOE9lR3VkcmRvRk5FMUpWYmRJaFQyRjN5QmVzY2FjeHpRdlJEWmc4UW9ZSVdFOEV5dlBLaWZRQUNxZjhDVTZxbVd6U1lPOUJGSkFmL2xsbDI2TVFMbWtoWWg1cnh0eHdvbCtYMVQ1U1BFQWdEMFF6cTdsK0R2QisvVks3OVlRZWsrOUUrU1pxWjM4UFZuWWwwSXBSbUxOMkRvN2pySEJMVzFlekxobjFjRFJrTmVSWWpPWHpRUVlvdzRuOEZRTlkrWnc1ejhiVUVnQW93Y09WSlNVd3FXNE04UmRtT013bE1lVENQS2VlWGNoRnRaaVJGRkdaU3RGOGlUQmFEb1dyM2pDcWU5OWNhLzB4YTM3THJRdWhOOU1JTWlUZkpOekhUU1VOSGZqNDdCUjBIbnBTZkF3TERybzNJMjBUdWFhS1VQaHpEVnYwRkFOb2dncDEwMTJQMU56MHllYXNScWh1aEVoZ0htNWI4L0xhdWJscTBVdTVjVis3WHp4eUZvamNEL0dmSjNrenZIVWhiVTJwZXZOWHlCZmtqZmFtRUNLd0U2b1Bna1k4N0crb0lpdHg5WWpHZ3VxQnljUGRLWXI5aUNQR05Sd0VYZ01SaE1nSUo5TTllOVhDak5KRnVlWFVlOXZiNlJSS2NJeDNjaUtvbzA2MkFMemdBMHpYeUlMc1VGaUt4SVpwTG02YVBXaUg4bnRsMGthUXZHZ2RpMVFTckFNdU5Ha2dXelh3TGlGbStWcTlIaVhOenJyV0Jyazl5aWp5dlBxbEhPU1JPU2tiZ0hJRHpnaHFPNkhQMDFMWlYwK3hzQnBKbDFkSnpWdEZtS2lIYXBIbGVXZ1p4eG1IcW5DTVZPcGdTTnB4c2hlVHphVE93bkJwWS9TSFBsN29BNjNEUlVObEZlQTF2Q2NUaGN6Z1VqOTU0TjhLMDdLTS81TGRzUXhITUp2QjRjS3EzRFpuLzAvR2kyRldXdHNtb1BxV2VVK2VvZ2RJQVFNVlF0UHV1TXYwTHVNT3RZK0VjV2QvZFdNSVRPRGhOSGxFbXdjbVpBRDNFdHRXdGJQcTE3OXdiaXRLaEpFOTlpdncrWkhiRUxkUmVaVjliUDlKM3Jla2hUVDllMk9BOTROYzVlOXVSWkRaYTdncENHRFVILzBBMmFpOG5GRGdCcXc1MFp5d21oVzZMOEpyYzJ1di8yZ3RVNEVZbjNhYU12Z0dHeFJSRG5hUkxra1NCT0M3ZmFjeHdBU0lqWUt1NFhENHpNNFNnNzJURkNadEJ2TGZRaG5vcmxsaFM2dVo1bGhzWVZEdzR4b2dCYmw0bnFYZG5xdEp5U2h1Y1JpK0d3Z2RZZlVWZVRpNUVhV0NTWGRqRnVHUzZUNnUzTnQ4V01EU3BZZkNHSlUrK3NoNldlSEViN2xQRWlyT1Q4TEVRRkZNVHYxRUI2Qm1MWE83RXc2UzdlT0NwN3kyeDBBZzR5N0ZTWlh5QjdHUWxiVTZLS2xmbndQemJzOVJURHc3WXlHVmlPT3MrQ25INVloanhIWUVVVWw0UjNlalNDbVdBTXo5ZkJRbEZFelo2QzdzR1BOSWo3M3FuT1hiYkFNVitFTDVjV01SUERQUW1NZll5OGZIYk1SYmdsY0ppR3VqTjVrYXgvejhQejdFWi9WRWRMTDVqOTl0bFVMMUxUWVk5M0NuR2wrNTYzT0ZzWCtZandGc2hoMkQvcHM1cHd3c212SEFsc2J1QWl6N1l5a21teEYvMm9rbHYrMnhLbis0am9hQTFEdVdhUmdZRFE5Mk9UYzlZaWRKSFkyQXZUSG9aMk1QWjJ4MzVoTzV6S0tvK2hoeUpvZS9PaUtQaVZ6dDd6ZVRmVlhBM0g0TjM1a0dIdWl4STJCT0dsRFh6S3hYcHpHZldsRFFyUTAyc2dCRDJzeUVpR2RzT1pmRXR0T3dsY1dzM3B3aHdsTEhqVzc4V0w3N05BNGlyRXkzN0xkaWlLYUliT2p5VTZtWU5kQ0pKZTJJakx1S0crTVphVGtoOEhkV0IrVHRjQ3FFNVRFZjFjcnVZSlRkTXUwNzNiNWZNeXFxVUQ2SkJUbEwrODNzNVlTUUc0UTFncVA3OXNvQmlwNDc4b1lvaFJPZDNRWVRmN3hHS1VwKzF0M0NBaDlhY29pdzJacGFZMVA5N1owQ0MzakVUUm51VllGZVJuNXgwejFUK3FDQ0pVSGV0Vm90czIyK2VheW8rTnE1dVc4Wk9rRVpWQXk0YWxFd01hS3NOdWZQcDAwZ2UwYW9taUNpcU15d1pLYWk3VVRoZ05vaE44aFF3QjR3R1BNMkNxcUZISkJWZG5Ld2FOdFdudnlvcGk0UUpEYUNyQmNCa204VEt3OHJ5V3F4cGJXaVU3MElqVFdqL0x5M1FNTU0rUHdvdEVPL2VBMVl3MCtqNjNUNkxWT3ZjdVFHZENLR0loNk0vemtBL25MbVhJbDN6RXhQazNlMUlzbXVrQ0VYRThTMjJtbUx0cHN6ajJGcEF2cUZYM1ZwckMzVEZmYTNqTzIyMXU3Z29sajFPNXdCS01nV0x4YmR6TFR0QUgyV3kvbXBobDhYR3FJVHZzSCtFVTF4bEJ4Yi9Ic1JKYWw4NUJWcWtKanE3NFhmQkdveXQrUjdoV01XMTNLRk1EUUhYdXR5Mk1YTS9FZzhDTU5SdFhEVDhiNzEyZEVtZTkyTjMxMERlUDVLdElpdDJrVnh4cXF4b3BLQnlKTGVTUGJHd2JuQWF1MHFuRVY2ZldZRzdlWXNFOWN0MzZRTTNOUHNySEFHRHpVbzZKZ25naVZqZEhnaVdXaHZ2QnFsTWd0Y3ZSdmliNlpPQTNBdVJ1NnVZbElmZ1l2OUdLSnllVFI1WG9uK1lDZitEeVYzbUdZa2kxM2toLzJzRDBiZE9ka1QzTGxwMDRGNWFjWDBaK005N3VKZGM5SUFGQnZxeUhWek5SeE43SmhUb1IxRDNXSTZLTGFoRmIvajROL2FNOUlxSWd4b1ZYNmVETUxzNG4zdHZxb0dXa2ZJUXE0UjdSb1N4L1BnYlZxTncrSzYrZXY1QzVJRjFDT20walpYOXE1NlUrbkI4N0oydGlUZDFJYUZFdEY0MVFRMUl0alhIQ0lGazhjdU1Yb2E5QW5KZStGd3N4Y3dVMUl5czg4Z0JmdFBnWUVpZS9pdk4vMU9UYkZvN0hESnRKNWJycWFqZmNhNndDSTlTM1JPQ3dwOFlTQk1lTUNVb0pTcyt2ZEUwWGdoWEdpWVk5ZXVGa0pWNWdoR2JMc3o0d2RxSG5QOEQzUUIxRktBcG92enh0aGdCK2V6eGxsZUFYYVhlSWhaUGVFeTRmMytHYThPclJJMHNSTExPajIwUFBXY2xnS0VQc1hJU2FxV3dsaHA2MU5IYWFnRzRPYmhCSmpvbFRRdU1KWTgxRXhwdXhnaHZoUVRtSkZodWY0M1lEVDNyL1I5dFNHYzgrWGZHRTdjQVRCVm42SlFSK0xudUlXdURyaXFlSWhtU2tNM0pvRkt3YUxud3VTMXp3RFRTSW1SeGthbHJZQTF5SHJUQWF3WmJ3a0ZXZUdxcjYwREp1aTJpOU1nSUM2VG1jZmJneStzN0hNRm5Yay93SFJqVG9WTWQ2M1V4Z3NIUTdPbUo5Q3lGbDd5N3JpbnZWRjEzTDZNeCtVUFZRdlBTL0ljS2VWa0lWaTA4TjdLTVg4TEJpZmlITkRLZFpsN0ZscDdmcVZ2UVJVcWlVQVY2cEV5T0dINnFSM29vZzJGODZmc1U4WnZzR0tRZXJmRXJBL3J3alhna2dLSm05aDhSY2F6WXhBRm9aRHVZYmRSYi9XSU1Cem9kQkMwckZwbTdWTUhNd2N6UURiaFh2V1NIMXRNN2lmNnZTVXE5REs5cTVsWVUrMEZuaFlEVDBkVjkwZ3dJRVA1eEx3a2RUY3BrMkh4NUM0V0ZtWmNXTUdaVFFQUGltOWhnUTJYNTJnS1lOeEo1ZndsR21EMFhmd0Erb01zRGZTTGxOMlI2YkErb05PUWdTZFkzdnBseUI2MTI1K1Z5SXIzSGltRmtONGN3TXhaZHBNMGhDMTYwNEE2V2pqelVMQ1lTZHlwSHQ5UWR5Mk5KU3NoM015QkY0K2FBUlVPRTVmQytQYUZrc3dNbFA5VUk4TkRWUmswRG1YbVZNZjhLSVJwOXpKSDF2V2ZqWTlBUzJibGF5NUVBTjgxZUFTeU1DdmVvckNOcEJ4MGYrNFVVRXR3ZlZOZlRPcWs2MGNaN01jbUdFK2FoTlRPeEVTMlNmN1MrWjF6UHQ2VEhBNVNWb1I4Mkw1QkVtbWRySWFkTWF4NnBOWHJtNjNVSVJEa2c1UVczVE1qTXVuWnhReU9QUmV1SmhUMG5FNElZUXZzMWdGdks1SWJRd2hFTEpaVWU1ay9Oc283cUxOdWRGYXlKbVh1RXc0R0FyeTltSkQ5cWJCTENtTGJRN2RPU1BsVUEwZ3gwOG5URHkvdVpBbFM5R1Z5Sk5mWmJLQW15N1A3MTlUUFZIVDY1MlY3aUdvQitlenkrbFhWOHdGd3NzcGJLVGUwYkhVQUQ0S0NWL3I2RVMzZzYvSjVXQ3FScXhlQ0JnTXlKWjQxS2ppbTR6V1lac2lGQk5zOVVnb1A5OW16WlYxUFFkTm5IaHJXcFdwWmMyN3EvS1hJa0o3T0cwTmNKNnhNdlE3RFJSaEFHblBXN2tPKzRQbWdTVUFtOUlaSGMrRFRTUi9RZUtnM1Q3MDFjSjlTcXJXakZCbEF2Vkl3c1E2cEd1QXYybXk3QXpFdm1nMFVDdk1mT1h5OXR4a200NXRSNE5WOS9mZUJidnd0aUlzWFhJVzJXUUxjbm5mTnNGL2Vla2pJQWNpb2RaYVNPUHZXLzJsLzJHSklpd2NSdEJzT3AvUHJ2ODNiYlV0dm5OL0JDb3RtdVhEakxXc0VFM2NKZENkQmJBNy9DVHcyRGRUeEppMTdzV3VYODA5QkdqbENvdVhoMFR1ajZCT2VBcUhQNDEzeWVacFk3YnkzRHVOOHI1VGNaZE53ejBvWWNwaG4xMWxGOEcycTdrYmZzcllUK1VscVRWSEtuYXlJU3phcXFIdmZoSkZLMkV3TGcrRjN5YWhUcS9kNXVRUFl6dU9GTERRZVZlTkdtZmJ3a1BjckJSNGlRZXUwdG1WVkpTcU1Sdnp4SFBiaHVQN2NqbVg2LzdxcXBCYit2VDNaOUFNclZ5eHIwVWVLWHVVSFBPVXJLQS84ZURwWjI4WU9lQjA1SXFFM0NBeEpFa1JETERTRkRTVTQrZU5QNmZDVXEyQWJaV2VOTVQ1MFkydXE4Q1MwUzFudlVid2pYakt3dEhFUklpTEEvY2xVUitWVjd5UmVVSnBSYVVUZkJ2RHltaUtleXpMQXVwV21acHI1aFBhVUN6REhjZXkyNmpKM3MzZE1RbWtFZHRDSHU4TlZWSXpSbHlmWHkrUExNUzN2UjNJNk9YMC94bWEwOEhSSlBEQlYxTGVJT0VHamI1MHlySmRqM0hWa2JkUldWVFZDckRucDE4RWxwSGtlVFZNb2luMTQyVHExVndvdXVKSlkvWGhoaFJFaTJPVjB2QWo4eklaVWRWRTFEVGpTTXZUR0ltQTdqZ1Z5eW1ZQlZWZGcrZkhJMnVsYVlRV0xDOExkeTVYem9CSHN2ZU13TW96K3dGZ0tpNElBYmRZTk9tTzlWenVqdmpnT3FlaVJRNUwvSDFUY1NhYnU5eHVhaE9NQXRaSmNEM2RzSHFNZUJSUURNL1dCWUNHN3NtMFUzYXBPSlNMdUNpL1U5aUgraXRnQTRCbENONi9hc3JrL1dSVkJhZG9LV2FFZ1lmOWJzak5ONUI0TkJIZHdBOEdsMGc5QmlQc2hldERGY2tkOTExRHhkQ01IaXQ4YVh0Rms5Q3c3eFhwSmxudjVXWkpIbkpEY2NPeTZHWCttZk5Rbzg2OEpCMWpGVkF0YzYzYUovWXBNU0lKaXdSY2xGU3NuMks0YU94aURaeTU1clRRVlRkWHFSeWJ3cWVORVJFbXZLZXBLQ0NOVEo5REcveVNORndiS0dtSmpVdzVHMytoZm9uV0hvUE5jcGtMaEE3aTF5OXV6b1ZuT3NTS0srRzVrdk9Rc3ZaeUtkMHNiS0hrL2hTclc3SDBtMENlS0w0eHh4Und0dGZiOWlPOERGdTdwQ1BFeEhONTltNkNnQXNLa05EMk9KUGFzQ3RtSkUrN0FHblRuTEE4K250bmdRQTQwMEMrVG5wQzRuQkpPejMzelBPRk1wZ2s1Q3hQenVzb2RvNE8vTk84dGgzajF6UWdJR3dtYXdzN1BSU21sVi9ScHlOS2RlcXVicmpQRWFmWDR5MGg1VUVxUGpjR3pPcEt4LytDY3dBTFdVZ29BZGlKajdrdjJXcnRia2I4bG1UeEVjWWw3cnZhekt2eTNuNlYxRGM1T0I3Q2Z0eGZ5QTVRZzR5NWNaZ1MxSEFqOGpFdUNybkZDcFlCTllwUFMrM2d4T1k4enRQLzBtc0VmVGFGTmN5ZXhnbGtsTFhMSVFTTzk5SGtjSkNtZWxlUllaUHk3T1J6Y05WNk9SVEtrVjhpQTROZElXeTduRGpiRFA1VTRUMS92NEFmaEUzVTJjYjdBTVR6UGpEa1dpQTRpbW5PdmZoRk9nM3Z0NkpzQjdlNGVXT21SRlpGOHRqS3dSS0tGQXE5SDZaM0JXcDEzYW1tcklFa3JmcXVPdWx2WVZrUW9EN0JlekpJbUU2VHJwMUUwQ2JIbHVKaTN1eHU3VEJUc3Jqd3ZWVm5YdzY4d2VJM3lBbFlyNG5uZzFUVXRJN3lQbFh5WXdwMVZmczZhYmVFNHMzeUpCMlRPVnBFZmJrQWZGaThMVWdkRkEvb0xJUEdNcDY4bXVzMU1FQi8wanpJVjVFK0RobldnVlF6QldDcUhQdkRyVlNTVkFmRXlVNW9uUEdTSi9WQ2daZU5KY2lwdlFQMldJUDUyYzZ6bFJQN1VFci9FL3pSSi8zL3kyMU5NYVA1aGM2eC9lTWhDdzN4UDhqMHc4YldhWDhTSmVVaERkdFRKalp2YjkxSGJoOTFObjlYMkpkVC9iUlY4bUpsaTBzV1JwWFZBN2RQdzIrR3hvL0l4bXpqckxSMWl5dE1qTmVQdkhIemdaaDQzVXp6TmVoSU8rV1VNb2lMQjljSnJSTXVGeHZHaWtxU2s3cG9tZzRzenNPOU0yZXQ2emF2bk12NUx5NldTOUpHR3BtN0ROL29ha0FOZG1BUDAwb0VMaDBHYmVjbEY0dzc3TkxETTIvbWRXRzhubEtkZDZMTFkvZUU1N0tRbTd4NDM1SW5tcUFmZHNlR3hUUzBWbjUzZzFVZ3l2MFh4dTdaYzJJdVNCVjN0Y0hVK21XQURXOFA3c1N1MVp2eHZRZExHMXhYeTFBUDl0SHQ1NDl2YVpyWXZFTWRYS1pvRlloZHo2eWpKSHlGdXNiaU9YWkMvM21NaEg2Umpab1hWOXlUT2YxbkdweUl1MXVuN0I0WmZOeG5tQ0hDc3g4R0VoVWhzdWU3a1dseHhKNHVFb3FjQmhneldyUGVQOUNjTzBzNm56OTl4NkpyMjFRLy9KdVhnRTVsNVRHUHFTNDhScHNtUVhNaFJMTGdjVkZENDk0a3RyMnAydE55UFh1ZDVqTkw4YW1acUR0enR6SlhYVDFrWFgzcE5USjN6L0E2QWVFcnNDbzEyTU8vWWpuMHp6MlpaYWd2UzQwZlZrR0VESXZFUUlqdjlpZWFjNm5qYkN5MmpGc1QrSXdsUk5mQzRaVUJlY0Nna2x6OERrTy9qVjE1T3dVb203MkNyMWx6cXZ3ZlZxaDZ6em1vckllMC9lZGpIZ0hwdFJZZkRSMkMyNE84QmQ5UDU0OWg3azBBV3JVRFkrSkxiZVp1ZGJ5dGRSSnJpSGgvaGsxbTRqYlBWY3dncE8zTWhRSDJhMVVtY0E3MjY0TDlGM0x5TVNHSWgwNnNRb29zdWhLM1VsS1RLbE10QlUyenM1QThOS2s5S0w1d2tFbnlLMFBaMkZ4bzNhWnlOamJMeVRKV1RFMWJRRkNaalNidnpRa3dMMFlycjVEN28wcnZJMHNSdWhuQlVLeXFMaFIwTW8yKzYwazhHNmk3MnFJcHpNSmcwMGl0WWtmbkRLaVN1UWYveVJPTmtHZHlSdWE4a0FZcXBydFZya1ZaQ1Z0eUt3bnAxUHRmMEJueTl6M1dKZGcxaVZCT2Q2UVpZVHBYSVJ4WEhGTHAwZi96RVErY1drazBWQ2lPbkw0MHAvYjlLbkhra3JUbXloTmxWMUxHMitJUEhBdG1GMGtBbXFtMVFIam1zOWZjc29qTGpBQlpJTUlhMXJoNFhxcUZadVptQytzbUVIVzJpNnRLcGY1R1FUZWhyY2NDMExmVUVTTndhY2JXUjRGNXZ6MXh2QjJ3UkRmOGRIOCtWeHltNHVoayt4MlNLSUdqaXJVT01XRFlWZFZwUTFvMEluZURQaG5MMmRRaVUyNnFGazd5U3JZZFVIZkJLNXA0SSsxOEcxaXZMSFdGSFFjV1hmdWhKYlpyU1ZjOEZUb0RVRkZVVWxJYWdZdTFmQkFLT2tJN016V2laT1VuMEVtWW8wRXpDd3RlZTA5N1cxc2o0dGc3S0Q5eTdTSGZtdnVzMVMvNS9zc3pmOHlyYVZtVlN6U0NTRk1FUk1pYllPcFRQdGsrVm10ZlV1OS95eit1UnQxOHFDUFphREdCM0xKYjhJRk1sbTBMNXc0M0d3d3JPYTNEU3F2bzJIVFRJcm1weVZFN1gxQVNvMmZPUmRIMFNOa2RiWXBFekJGRTFTMFgxblVZT1FSVVhER2JuYlVwQXBoMVcvVnVXd2MxdVlaZ2dlUTZaSWZ5dk9ZREZmKzNHYnllNnlwdElSZEtSK0dkT1dGU3A5NXdFQm9DejRqcnNrSEVPTVJwWkhyeUI0WHZIU0swZXU4d0EvaEUvZGVCV3JzYkdQS1pDUFdwamlGUmVBczA3QmYybWJjblZwRGJKWnpPYndIQSthT1hQUzRPMDZ0N2dxamdPdmZIU3pKdy82R3NDc1AvempIWWVkL2xrb29nNEFra2FqZ1g3SFFVdnVNLzBNUjk2ajhXQmsyM2ppTU1jeWtlUXlGa015MEpLWDVtT2Z2L2QzVHg3aDhTcUJaSDVRTVZEVHNFeWlFRG9pQW1lQ3owZjNpRlVSRlJlZnJMYUpFNFlrZ3Y5RGpYQmtjU05DeGFlQmpHQjY0aU40K04yREFOT1kyNXAxRW14bG91eGc0cGZjU2lTM3NGWHEwcTFLVUVCOGVaVEZ2eGx1eGdaRXM5YittR2xBOXBkMlpBSUhBNElpSmJ2SlBkaHI3L24zMXFZcW85ckdKQmgzSStCMVEvT0lGMVNLTmJ6MEpubm5wR1BRS3p4aGxwK2xYRmdCa1A3TXE0VnJSUmFZS29pOEFwMkMrT2xxZFhhdzRyelBSQjh2eXk1U0FOTTV2TlJPc3R5Ymt6ZzZJWEM4a2dRc2FzNTgvM3VDdFdHSGcxQXdBTWR6K2JhNWVCT3BaNUdmRHh2VTBWRFRnSm5JMjB0N2I1UlRMU3oxNkdHcUhLNW4yM3pPbnBiNkxMVGJnS2xEZXpjMUFGd0poYlEzVWNkblVyK2cxUkp2WS9sRnBNUXFtR01VenE4WmMwdndnckkvdDIrWHZhL3l3eG5XQUI5NWNRYm5Sa0dvd1VkRDhrSlkxQUVGU0FFMC9mdjFkdzhXNk5oa0hVNG8zLzJ4Q1RPZmYvckppdlZ1VTUwdFFaL2wwMDNDTFlSN2xSVllCeTZzcmNqaVF3WjBrNDQvYWt3R2VGQTkzZS9oOVRtTXlDenVMZnlIZUYvcmJnY2t4OFZLa2cwa004ejQwemZDK3pDbVU0SnFuRGhUVmFqdkFHeHZpZ2phT2t0ZktGUXM1Vk00WFBrT1NqMTAvdk1ETFFIRkx5UlkvK1dYZkxnK0FIdWtSSVlrWnZEaFRzdkZLVXhneUJTVUE2MWRSWVFvdXEyMll4cHRLaE04OFFjdW9XTGRMZjZsVDBwc3lMbE11ZEkyS3h4Ykt2NDRWaDBjRDYxYUhDV29DRFRVVlp1NWpqMnN4eGZ1TGtUZXY3NWMyQmNTL2Zqdzh5YWhpMk1rS1pDM3ZHZnJoY3MzNWMyWE1tc09UNUt0bm9XanEvSCtaOWV6cVhwS3E1MnVMeGVNeGlNTnEyMldOdE5ja2dHNTc1eXNhdDJjd3VVMUFYWk1QVk1EVlcwS0cwVlVzV1ZHVXg3ZHVSY05DUmV3ZElEbmg4RWRNQUNjenFIdEFEa2dMUnY3TXZzanJmZ0tBVXgxQ0VOQ0VDUEt3b1BBd1ZmUDltdTdzRzVTU2xqd1d4TW5CalR2bWExdllqcitjZXRDeE1JRm9MSDdQSFdxWWdTcEU5WFBxcmdZbmZ6VDNSUmhvVGNhQmxSZjRLa3FNRFZxV1lPKzFUK3htbWV4ZVlDSHNVeHlNQmRtT2pjRS9nNnRlZ01Jb2xjekhERm4yeE9RVGZSYWM0K3FFSnlHbXYrRk9sUUhsOG1Udm9yZ3RySWUxZlI3ZExRZVpESHBJNG1QSkNvMkRNR2FhQkhmQlJxM2MiLCJtYWMiOiIzNzI1ODNjMTc2OGQ2NGIxMTJlNjA0NDA5Nzg4NWYxYjE2MDU2NjNhNTI5M2Y1ODE2NmFlMzBjZjk3N2UyNmRjIiwidGFnIjoiIn0='),
(60, 'Ömerin Odası', 'Benan', 'u17ga6yznzt8', 'Benan', 'eyJpdiI6InYvdE4zWEZTMkRIeExsRTZ1R3FybXc9PSIsInZhbHVlIjoiMEF0UFpnUWdiaCtBYkE5Ulhac01NUlVWbnpZMTIzYTIzMVE0U2hmV3NPbTR5ZStxM3NTV0F5RFZXVHNZeml6U3N4R0ZXYURRc0MyUUlaSVUwMnUxUEhvOWVsVGlCeEVFQUxGWkJObHJtYklMR25sVFlkVjZiOUYyRXF2WitLbjZXL2pBV2c0bHRaK2lPeU8wNy9CQlhVYjBzMVorb09NanN0b0swWWloKzN2STc0NDh0WTNMbU5PdkdOZ3Z5MGFSbUk0cVJLN01zRFVPdTlWYU8xTGRrbEtjSlN4M2hKMmhJODZVcUFPK0lSOEM2R1B3UzZ6TzRjM3hmMFBBZ1Z5cFVOYllRVmFHVnZ2YWI2NERBbnozQmF2amlVcGxpbk11Rmc1ckRHVEFzSXNGVE0vNmtsaGFtRThZeEc3STJDNml4clllREJ0MjQ1dFJkUXd1QktGZXdmamZ1eVhPOW9QdUw4VnY0Ty92ZkQwSDdnc256QTd3VmwxdlE5bVYwS1VpU21Dcm5hS1hUejVQcUxuSk8ydmlWOUgwVmlIMDM0SXpybVFmbys2Y3R0V2tlQzFvLzJsL21iczdDcy8rTW4zc1ltN044ZFF6QkdNcnRYNnU4cnB1aVlmWnRZU3RUN3dkN0g1TFJPQUxUZDM3dnlaZUVNT2dqTlpGb1VQMk9uSkhUVHRIeTBHVk83Nms0TlpEQkI5YVBRNDFBRkNkcFBLVEYzZE9wTE9hTkZVPSIsIm1hYyI6IjlkOTRkMTE1NjE4NWZlNDg4MWYxOWE1ODUxZmJhNjhhMGRjN2U3NjI4NjY5MmIxNTFiMmNjZDRiZGVmMmZkM2YiLCJ0YWciOiIifQ==');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `session` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_author` varchar(55) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_date` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_image` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_tags` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_comment_count` int(3) NOT NULL,
  `post_status` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'draft',
  `post_views_count` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(66, 17, 'Değildirin Değili', 'Akif', 'Wed, November 03, 2021 - 07:32:49 PM', '16998668_1899107773668903_6556267900550551141_n.jpg', '<p>didğiğieğdiiğdiğğidiğdğdiğşşş</p>', 'Değil değil', 0, 'publish', 3),
(67, 18, 'İndirekt Pulpa kuafajı', 'Akif', 'Thu, November 04, 2021 - 06:09:30 PM', 'Bereket.jpeg', '<h2>Pulpa Odası</h2>\r\n\r\n<hr />\r\n<p><img alt=\"\" src=\"https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.fSsFAP-4j3Eqez9eIUKDLAAAAA%26pid%3DApi&f=1\" />Pulpa odasına aerotrö ile gireriz ama bizimkiler gelmedi.</p>', 'İndirekt, Endo, Pulpa', 0, 'private', 7);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(3) NOT NULL,
  `css` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `admin_access` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `site_status` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `url` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `admin_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `css`, `admin_access`, `site_status`, `url`, `admin_id`) VALUES
(1, '', 'no', 'hidden', '', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_lastname` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_sex` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_birthday` date NOT NULL,
  `user_city` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_country` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT 'Türkiye',
  `user_number` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_lastlogin` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_reg` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_image` varchar(250) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_role` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_likes` int(10) NOT NULL DEFAULT 0,
  `user_interests` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT 'Diş Hekimliği',
  `user_status` varchar(250) COLLATE utf8mb4_turkish_ci DEFAULT 'like good',
  `user_message_rooms` varchar(200) COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_firstname`, `user_lastname`, `user_sex`, `user_birthday`, `user_city`, `user_country`, `user_number`, `user_lastlogin`, `user_reg`, `user_email`, `user_password`, `user_image`, `user_role`, `user_likes`, `user_interests`, `user_status`, `user_message_rooms`) VALUES
(49, 'Akif', 'Akif Esad', 'Tosun', 'Male', '0000-00-00', '', '', '', '', '2021-10-13', 'akifesadi193@gmail.com', '$2y$10$/PFFjCKg8oY4fbM1gneoDuTmTeKIsHR/0U1rq4mvhyUNDMl3oWWv2', '2021-09-27-163231.jpg', 'admin', 0, '', '', '58,59'),
(54, 'Benan', 'Ömer', 'Tosun', 'Male', '2021-11-04', '', 'Türkiye', '', '2021-11-04', '2021-11-04', 'ak1ftosun@yandex.com', '$2y$10$yXQEcFKtjsCna6zc98qprOzVmCIqUjuQKLlEUm7/Xv9KVl3Sn/hIi', '', 'subscriber', 0, 'Diş Hekimliği', 'like good', NULL),
(55, 'BeroBaba', 'Bereket', 'ışık', 'Male', '2021-11-07', NULL, 'Türkiye', NULL, '2021-11-07', '2021-11-07', 'isildak@gmail.com', '$2y$10$Xi537PCb7N7kGzF5tFU0LuOv0JMHZTah5bA9hnC7ixKLyJhaTufIy', NULL, 'author', 0, 'Diş Hekimliği', 'like good', NULL),
(56, 'Dalong', 'Da', 'Long', 'Female', '2021-11-07', '', 'Türkiye', '', '2021-11-07', '2021-11-07', 'dalong@yandex.com', '$2y$10$dw7IFRhSQRu3hcIcE2RfeesSOhj3nW4QDGgx4emnzV8Q1YZFackhe', '', 'subscriber', 0, 'Diş Hekimliği', 'like good', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_inbox`
--

CREATE TABLE `user_inbox` (
  `msg_id` int(2) NOT NULL,
  `msg_sent` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `msg_author_id` int(3) NOT NULL,
  `msg_author` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_subject` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_reply_status` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Unreplied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `user_inbox`
--

INSERT INTO `user_inbox` (`msg_id`, `msg_sent`, `msg_author_id`, `msg_author`, `msg_subject`, `msg_content`, `msg_date`, `msg_reply_status`) VALUES
(31, 'Akif', 55, 'BeroBaba', 'Arkadaşlık isteği', 'BeroBaba kişisinden sana bir arkadaşlık isteği gönderildi:\r\n     <button onclick=\"acceptFriendRequest(\'BeroBaba\')\">Kabul Et</button>&nbsp;&nbsp;&nbsp;<button onclick=\"rejectFriendRequest(\'BeroBaba\')\">Reddet</button>', '2021-11-07 14:44:22', 'unread'),
(32, 'Akif', 54, 'Benan', 'Arkadaşlık isteği', 'Benan kişisinden sana bir arkadaşlık isteği gönderildi:\n     <button onclick=\"acceptFriendRequest(\'Benan\')\">Kabul Et</button>&nbsp;&nbsp;&nbsp;<button onclick=\"rejectFriendRequest(\'Benan\')\">Reddet</button>', '2021-11-07 20:24:52', 'unread'),
(33, 'Benan', 49, 'Akif', 'Arkadaşlık isteği', 'Akif kişisinden sana bir arkadaşlık isteği gönderildi:\n     <button onclick=\"acceptFriendRequest(\'Akif\')\">Kabul Et</button>&nbsp;&nbsp;&nbsp;<button onclick=\"rejectFriendRequest(\'Akif\')\">Reddet</button>', '2021-11-07 20:27:42', 'unread'),
(34, 'Akif', 56, 'Dalong', 'Arkadaşlık isteği', 'Dalong kişisinden sana bir arkadaşlık isteği gönderildi:\n     <button onclick=\"acceptFriendRequest(\'Dalong\')\">Kabul Et</button>&nbsp;&nbsp;&nbsp;<button onclick=\"rejectFriendRequest(\'Dalong\')\">Reddet</button>', '2021-11-07 22:19:23', 'unread');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `message_rooms`
--
ALTER TABLE `message_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_inbox`
--
ALTER TABLE `user_inbox`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message_rooms`
--
ALTER TABLE `message_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_inbox`
--
ALTER TABLE `user_inbox`
  MODIFY `msg_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
