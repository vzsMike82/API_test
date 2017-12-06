
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glofox_payment`
--

-- --------------------------------------------------------

--
-- Table schema `charge`
--

CREATE TABLE `charge` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table content `charge`
--

INSERT INTO `charge` (`id`, `payment_id`, `amount`, `created`, `fee`) VALUES
(1, 2, '50.12', '2017-12-06 22:21:49', '3.51'),
(2, 2, '19.12', '2017-12-06 22:21:59', '1.34'),
(3, 1, '100.12', '2017-12-06 22:22:06', '7.01'),
(4, 3, '19.55', '2017-12-06 22:22:17', '1.96');

-- --------------------------------------------------------

--
-- Table schema `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `iban` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ccv` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table content `payment`
--

INSERT INTO `payment` (`id`, `name`, `type`, `iban`, `expiry`, `cc`, `ccv`, `created`) VALUES
(1, 'Test111', 'dd', 'IBAN23565154544161', NULL, NULL, NULL, '2017-12-06 22:20:06'),
(2, 'Test112', 'dd', 'IBAN8262254645445444', NULL, NULL, NULL, '2017-12-06 22:20:28'),
(3, 'Credit card', 'cc', NULL, '2018-11-01', '9934', '1243', '2017-12-06 22:20:50'),
(4, 'Credit card 2', 'cc', NULL, '2018-01-01', '5566', '5463', '2017-12-06 22:21:10');

--
-- Indexek a kiírt táblákhoz
--

--
--  indexes `charge`
--
ALTER TABLE `charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_556BA4344C3A3BB` (`payment_id`);

--
-- indexes `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
--  AUTO_INCREMENT value
--

--
-- AUTO_INCREMENT  `charge`
--
ALTER TABLE `charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `charge`
  ADD CONSTRAINT `FK_556BA4344C3A3BB` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
