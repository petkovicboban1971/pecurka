-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:39 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pecurka`
--

-- --------------------------------------------------------

--
-- Table structure for table `dobavljaci`
--

CREATE TABLE `dobavljaci` (
  `id` int(11) NOT NULL,
  `naziv_dobavljaca` varchar(255) CHARACTER SET latin1 NOT NULL,
  `stanje` decimal(9,3) NOT NULL,
  `dobavljac_id` int(11) NOT NULL,
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `dobavljaci`
--

INSERT INTO `dobavljaci` (`id`, `naziv_dobavljaca`, `stanje`, `dobavljac_id`, `aktivan`) VALUES
(1, 'Miloš', '0.000', 1, 1),
(2, 'Sima', '0.000', 2, 1),
(3, 'Darko', '0.000', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dobavljaci_isplata`
--

CREATE TABLE `dobavljaci_isplata` (
  `id` int(11) NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `nacin` int(11) NOT NULL DEFAULT '1',
  `dobavljaci_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `firma`
--

CREATE TABLE `firma` (
  `firma_id` int(6) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `adresa` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `web_sajt` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `valuta` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `firma`
--

INSERT INTO `firma` (`firma_id`, `naziv`, `adresa`, `web_sajt`, `valuta`) VALUES
(1, 'Pečurka', '78250 Laktaši, Banja Luka, Bosna i Hercegovina', '/home', 'RSD');

-- --------------------------------------------------------

--
-- Table structure for table `grupa_proizvoda`
--

CREATE TABLE `grupa_proizvoda` (
  `id` int(6) NOT NULL,
  `naziv_grupe` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `grupa_id` int(6) NOT NULL,
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `grupa_proizvoda`
--

INSERT INTO `grupa_proizvoda` (`id`, `naziv_grupe`, `created_at`, `updated_at`, `grupa_id`, `aktivan`) VALUES
(1, 'Šampinjoni', '2019-04-25', '2019-09-10', 1, 1),
(3, 'Bukovača', '2019-09-10', '2019-09-10', 3, 1),
(4, 'Vrganj', '2019-09-15', '2019-09-15', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jezici`
--

CREATE TABLE `jezici` (
  `jezici_id` int(6) NOT NULL,
  `spisak_jezika` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `sr` text COLLATE utf8_croatian_ci NOT NULL,
  `en` text COLLATE utf8_croatian_ci NOT NULL,
  `cr` varchar(255) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `jezici`
--

INSERT INTO `jezici` (`jezici_id`, `spisak_jezika`, `sr`, `en`, `cr`) VALUES
(1, 'SRPSKI', 'VIDI STRANICU', 'WEB SITE PREVIEW', 'ВИДИ СТРАНИЦУ'),
(2, 'ENGLISH', 'ODJAVA', 'LOGOUT', 'ОДЈАВА'),
(3, 'ЋИРИЛИЦА', 'DOBRODOŠLI NA VAŠ ADMINISTRATIVNI PANEL', 'WELCOME AT YOUR ADMIN PANEL', 'ДОБРОДОШЛИ НА ВАШ АДМИНИСТРАТИВНИ ПАНЕЛ'),
(4, '', 'ULAZNE STAVKE', 'INCOMING ITEMS', 'УЛАЗНЕ СТАВКЕ  '),
(5, '', 'PROIZVODNJA', 'PRODUCTION', 'ПРОИЗВОДЊА'),
(6, '', 'Unos novog radnika', 'New worker', 'Унос новог радника'),
(7, '', 'Opis', 'Description', 'Oпис'),
(8, '', 'KUPCI', 'BUYERS', 'КУПЦИ'),
(9, '', 'O nama', 'About us', 'О нама'),
(10, '', 'Pretraga...', 'Search...', 'Претрага...'),
(11, '', 'Unos opisa', 'New description', 'Унос описа'),
(12, '', 'Unos podataka o firmi', 'Enter company data', 'Унос података о фирми '),
(13, '', 'Promena korisničkog imena/lozinke', 'Change the username/password', 'Промена корисничког имена/лозинке'),
(14, '', 'Nova stavka', 'New item', 'Нова ставка'),
(15, '', 'Pregled stavki', 'Review of items', 'Преглед ставки'),
(16, '', 'Stavka', 'Item', 'Ставка'),
(17, '', 'Lista stavki', 'List of items', 'Листа ставки'),
(18, '', 'Nabavna cena', 'Purchase price', 'Набавна цена  '),
(19, '', 'Porez', 'Tax', 'Порез'),
(20, '', 'Zaračunata marža', 'Charged margin', 'Зарачуната маржа'),
(21, '', 'Obriši', 'Delete', 'Oбриши'),
(22, '', 'Dobavljač', 'Supplier', 'Добављач'),
(23, '', 'Proizvodna cena', 'Production price', 'Производна цена'),
(24, '', 'Zatvori', 'Close', 'Затвори'),
(25, '', 'Uredi', 'Edit', 'Уреди'),
(26, '', 'Nova grupa proizvoda ', 'New product group', 'Нова група производа'),
(27, '', 'Novi proizvod u okviru grupe', 'New product within the group', 'Нови производ у оквиру групе'),
(28, '', 'Pregled proizvoda', 'Product overview', 'Преглед производа '),
(29, '', 'PRODAJA', 'SALE', 'ПРОДАЈА'),
(30, '', 'Veleprodaja', 'Wholesale', 'Велепродаја'),
(31, '', 'Maloprodaja', 'Retail', 'Малопродаја'),
(32, '', 'Akcije', 'Actions', 'Акције'),
(33, '', 'Glavni meni', 'Main menu', 'Главни мени'),
(34, '', 'Podešavanja', 'Adjustments', 'Подешавања'),
(35, '', 'Tabela preko celog ekrana', 'Full background', 'Табела преко целог екрана'),
(36, '', 'Boje', 'Colors', 'Боје'),
(37, '', 'Prikazi', 'Layouts', 'Прикази'),
(38, '', 'Mala tabela', 'Compact table', 'Мала табела'),
(39, '', 'Boja pozadine tabele', 'The color of table background', 'Боја позадине табеле'),
(40, '', 'Označi', 'Mark', 'Означи'),
(41, '', 'Korisničko ime', 'User name', 'Корисничко име'),
(42, '', 'Lozinka', 'Password', 'Лозинка'),
(43, '', 'Prijavite se', 'Log in', 'Пријавите се'),
(44, '', 'Da li ste sigurni da želite da izvršite brisanje podataka?', 'Are you sure you want to delete this data?', 'Да ли сте сигурни да желите да извршите брисање података?'),
(45, '', 'Unos nove ulazne stavke', 'Enter new incoming item', 'Унос нове улазне ставке'),
(46, '', 'Naziv stavke', 'Name of item', 'Назив ставке'),
(47, '', 'Snimi', 'Save', 'Сними'),
(48, '', 'Ažuriranje stavke', 'Update item', 'Ажурирање ставке'),
(49, '', 'RADNICI', 'WORKERS', 'РАДНИЦИ'),
(50, '', 'Način zarade radnika', 'Way of workers earning', 'Начин зараде радника'),
(51, '', 'Pregled zaduženja/ razduženja radnika', 'Review of Charge/ discharge of worker', 'Преглед задужења/ раздужења радника'),
(52, '', 'Ime', 'First name', 'Име'),
(53, '', 'Prezime', 'Last name', 'Презиме'),
(54, '', 'Grad', 'City', 'Град'),
(55, '', 'Ulica', 'Street', 'Улица'),
(56, '', 'Broj', 'Number', 'Број'),
(57, '', 'JMBG', 'Personal number', 'ЈМБГ'),
(58, '', 'Br.l. karte', 'ID number', 'Бр.л. карте'),
(59, '', 'Izdata od:', 'Issusued by:', 'Издата од:'),
(60, '', 'Izaberite radnika:', 'Select worker:', 'Изаберите радника:'),
(61, '', 'Status', 'Status\r\n', 'Статус'),
(62, '', 'Zaduženje/ razduženje', 'Charge/ discharge', 'Задежење/ раздужење'),
(63, '', 'Unos načina zarade radnika', 'Way of workers earning', 'Унос начина зараде радника'),
(64, '', 'Ovlašćenje', 'Authorization', 'Oвлашћењe'),
(65, '', 'Unos novog kupca', 'New buyer', 'Унос новог купца'),
(66, '', 'Ažuriranje podataka o stavkama', 'Updating of incoming items', 'Ажурирање података о ставкама'),
(67, '', 'Brisanje odgovarajuće stavke', 'Deleting of incoming item', 'Брисање одговарајуће ставке'),
(68, '', 'Ukoliko stavka učestvuje u formiranju proizvodne cene, označiti je klikom na ovu ikonicu ', 'If the item participates in the formation of the production price, mark it by clicking on this icon', 'Уколико ставка учествује у формирању производне цене, означити je кликом на ову иконицу'),
(69, '', 'Pregled podataka radnika', 'Preview of worker''s personal data ', 'Преглед података радника'),
(70, '', 'Brisanje radnika', 'Deleting of worker', 'Брисање радника'),
(71, '', 'Da', 'Yes', 'Да'),
(72, '', 'Ne', 'No', 'Не'),
(73, '', 'Način zarade', 'Way of earning', 'Начин зараде'),
(74, '', 'Rad od procenta', 'Percentage work', 'Рад од процента'),
(75, '', 'Rad za fiksnu platu', 'Work for fixed salary', 'Рад за фиксну плату'),
(76, '', 'Stalni radni odnos', 'Permanent employment', 'Стални радни однос'),
(77, '', 'Honorarni rad', 'Part time employed\r\n', 'Хонорарни рад'),
(78, '', 'Neaktivan', 'Inactive', 'Неактиван'),
(79, '', 'Direktor', 'Manager', 'Директор'),
(80, '', 'Poslovođa', 'Cheef', 'Пословођа'),
(81, '', 'Radnik', 'Worker', 'Радник'),
(82, '', 'Pomoćni radnik', 'Auxiliary worker', 'Помоћни радник'),
(83, '', 'Ažuriranje podataka kupca', 'Updating of buyers data', 'Ажурирање података купца'),
(84, '', 'Naziv kupca', 'Name of buyer', 'Назив купца'),
(85, '', 'Žiro-račun', 'Number of acount', 'Жиро-рачун'),
(86, '', 'PIB', 'PIN', 'ПИБ'),
(87, '', 'Lista kupaca', 'List of buyers', 'Листа купаца'),
(88, '', 'Uspešno izvršen upis novog radnika!', 'A new employee successfully entered!', 'Успешно извршен упис новог радника!'),
(89, '', 'Uspešno ažurirani podaci radnika!', 'The employee data successfully updated!', 'Успешно ажурирани подаци радника!'),
(90, '', 'Brisanje radnika izvršeno!', 'Deleting a worker done!', 'Брисање радника извшрено!'),
(91, '', 'Brisanje kupca izvršeno!', 'Deleting a customer is done!', 'Брисање купца извршено!'),
(92, '', 'Izvršeno ažuriranje podataka o kupcu!', 'Updating Customer Data Completed!', 'Извршено ажурирање података o kupcu!'),
(93, '', 'Uspešno izvršen upis novog kupca!', 'Registration of a new customer successfully completed!', 'Успешно извршен упис новог купца!'),
(94, '', 'Uspešno izvršen unos nove stavke!', 'Successfully entered new item entry!', 'Успешно извршен упис нове ставке!'),
(95, '', 'Izvršeno ažuriranje podataka o stavci!', 'Data of item completed!', 'Извршено ажурирање података о ставци!'),
(96, '', 'Brisanje stavke izvršeno!', 'Item deleted!', 'Брисање ставке извршено!'),
(97, '', 'Pregled grupa proizvoda', 'Review of items groups', 'Преглед група производа'),
(98, '', 'Naziv grupe proizvoda', 'Name of group', 'Назив групе производа'),
(99, '', 'Unos nove grupe proizvoda', 'New items group', 'Унос нове групе производа'),
(100, '', 'Uspešno izvršen upis nove grupe proizvoda!\r\n', 'Registration of new items group successfully completed!', 'Успешно извршен упис нове групе производа!'),
(101, '', 'Brisanje grupe proizvoda izvršeno!', 'Deleting a items group is done!', 'Брисање групе производа извршено!'),
(102, '', 'Ažuriranje uspešno izvršeno!', 'Updated successfully!', 'Ажурирање успешно извршено!'),
(103, '', 'Unos novog proizvoda', 'New product', 'Унос новог производа'),
(104, '', 'Naziv proizvoda', 'Product', 'Назив производа'),
(105, '', 'Cena proizvoda', 'Product price', 'Цена производа'),
(106, '', 'Uspešno izvršen upis novog proizvoda!\r\n', 'New product succsessfully stored!', 'Успешно извршен упис новог производа!'),
(107, '', 'Brisanje proizvoda izvršeno!', 'Product deleted!', 'Брисање производа извршено!'),
(108, '', 'Ažuriranje proizvoda izvršeno!', 'Product updated!', 'Ажурирање производа извршено!'),
(109, '', 'Grupa proizvoda', 'Product group', 'Група производа'),
(110, '', 'Ažuriranje proizvoda', 'Product update', 'Ажурирање производа'),
(111, '', 'Ažuriranje podataka o proizvodu', 'Product data updating', 'Ажурирање података о производу'),
(112, '', 'Brisanje priozvoda', 'Delete product', 'Брисање производа'),
(113, '', 'Аžuriranje podataka o kupcu', 'Update buyers data', 'Ажурирање података о купцу'),
(114, '', 'Brisanje kupca', 'Delete buyer', 'Брисање купца'),
(115, '', 'Izaberite radnika', 'Select employee', 'Изаберите радника'),
(116, '', 'Izaberite kupca', 'Select a customer', 'Изаберите купца'),
(117, '', 'Nemate ovlašćenja za rad!', 'Access denied!', 'Немате овлашћења за рад!'),
(118, '', 'Administrativni panel', 'Admin page', 'Административни панел'),
(119, '', 'Zaduženje radnika', 'Assign workers', 'Задужење радника'),
(120, '', 'Marže', 'Margins', 'Марже'),
(121, '', 'Datum', 'Date', 'Датум'),
(122, '', 'Izaberite proizvode', 'Select products', 'Изаберите производе'),
(123, '', 'Unesite količinu proizvoda:', 'Set amount of product:', 'Унесите количину производа:'),
(124, '', 'Količina', 'Amount', 'Количина'),
(125, '', 'Cena', 'Price', 'Цена'),
(126, '', 'Procenat', 'Percent', 'Проценат'),
(127, '', 'Dodaj proizvod', 'Add product', 'Додај производ'),
(128, '', 'Zaključi zaduženje', 'Close order form ', 'Закључи задужење'),
(129, '', 'Poništi', 'Cancel', 'Поништи'),
(130, '', 'Valuta', 'Currency', 'Валута'),
(131, '', 'Izaberite valutu', 'Choose currency', 'Изаберите валуту'),
(132, '', 'Da li je završen unos za radnika', 'Has the workforce been terminated ', 'Да ли је завршен унос за радника'),
(133, '', 'Da li je završen unos zaduženja za kupca', 'Whether the debit of the customer has been completed', 'Да ли је завршен унос задужења за купца'),
(134, '', 'Faktura za kupca:', 'Invoice for customer:', 'Фактура за купца:'),
(135, '', '(potpis)', '(signature)', '(потпис)'),
(136, '', 'Predao', 'Handed over', 'Предао'),
(137, '', 'Primio', 'Received', 'Примио'),
(138, '', 'Štampa', 'Print', 'Штампа'),
(139, '', 'UKUPNO ZADUŽENJE:', 'TOTAL CHARGES:', 'УКУПНО ЗАДУЖЕЊЕ: '),
(140, '', 'Pregled zaduženja radnika', 'Overview of labor indebtedness', 'Преглед задужења радника'),
(141, '', 'Kupac', 'Customer', 'Купац'),
(142, '', 'Zaduženje za kupca', 'Debt to the buyer', 'Задужење за купца'),
(143, '', 'Ukupno zaduženje radnika', 'Total indebtedness of worker', 'Укупно задужење радника'),
(144, '', 'Za izabranog radnika ne postoji zaduženje!', 'There is no indebtedness for the selected worker!', 'За изабраног радника не постоји задужење!'),
(145, '', 'Fiksna plata + procenat', 'Fixed salary + percentage\r\n\r\n', 'Фиксна плата + проценат'),
(146, '', 'Iznos', 'Amount', 'Износ'),
(147, '', 'Fiksna plata\r\n', 'Fixed salary', 'Фиксна плата'),
(148, '', 'Zarada radnika', 'Earnings of workers', 'Зарада радника'),
(149, '', 'Stanje (kg)', 'In stock (kg)', 'На стању (кг)'),
(150, '', 'Razduženje radnika', 'Discharge of worker', 'Раздужење радника'),
(151, '', 'Pregled magacina', 'List of warehouses', 'Преглед магацина'),
(152, '', 'Novi magacin', 'New warehouses', 'Нови магацин'),
(153, '', 'Magacini', 'Warehouses', 'Магацини'),
(154, '', 'Da li ste sigurni da želite da formirate novi magacin?', 'Are you sure you want to create a new warehouse?', 'Да ли сте сигурни да желите да формирате нови магацин?'),
(155, '', 'Magacin uspešno kreiran!', 'Warehouse successfully created!', 'Магацин успешно креиран!'),
(156, '', 'Nazad', 'Back', 'Наѕад'),
(157, '', 'proizvoda', 'products', 'производа'),
(158, '', 'Prikazano', 'Shown', 'Приказано'),
(159, '', 'оd', 'from', 'oд'),
(160, '', 'Prethodna', 'Previous', 'Претходна'),
(161, '', 'Sledeća', 'Next', 'Следећа'),
(162, '', 'Magacin', 'Warehouse', 'Магацин'),
(163, '', 'Ukupno u magacinima', 'Total in warehouses', 'Укупно у магацинима'),
(164, '', 'Glavni magacin', 'Main warehouse', 'Главни магацин'),
(165, '', 'Magacin1', 'Warehouse1', 'Магацин1'),
(166, '', 'Naslovna', 'Home', 'Насловна'),
(167, '', 'Potvrdite', 'Choose', 'Потврдите'),
(168, '', 'Izabrani radnik', 'Selected worker', 'Изабрани радник'),
(169, '', 'Uneta količina mora biti veća od nule!', 'Entered amount must be greater than zero!', 'Унета количина мора бити већа од нуле!'),
(170, '', 'Uneta količina je veća od stanja zaliha!', 'Entered amount is greater than the stocks!', 'Унета количина је већа од стања залиха!'),
(171, '', 'Magacin2', 'Warehouse2', 'Магацин2'),
(172, '', 'Prethodna razduženja su preuzeta!', 'Previous expansions have been downloaded!', 'Претходна раздужења су преузета!'),
(173, '', 'Kraj zaduženja radnika', 'End of charge for worker', 'Крај задужења радника'),
(174, '', 'Lista zaduženih radnika', 'List of employees in charge', 'Листа задужених радника'),
(175, '', 'Ukupan iznos', 'The total amount', 'Укупан износ'),
(176, '', 'Prethodno zaduženi radnici', 'Previously indebted workers', 'Претходно задужени радници'),
(177, '', 'Potvrdite zaduženja!', 'Confirm your assignments!', 'Потврдите задужења!'),
(178, '', 'Izmena proizvoda', 'Change product', 'Измена производа'),
(179, '', 'Izmena količine proizvoda', 'Changing the quantity of products', 'Измена количине производа'),
(180, '', 'Način prodaje', 'Method of deleveraging', 'Начин продаје'),
(181, '', 'Keš', 'Cash', 'Кеш'),
(182, '', 'Žiralno', 'Payment on Account', 'Жиралнo'),
(183, '', 'Magacin 1', 'Warehouse 1', 'Магацин 1\r\n'),
(184, '', 'Magacin 2', 'Warehouse 2', 'Магацин 2'),
(185, '', 'Razduži!', 'Perform deleveraging', 'Раздужи!'),
(186, '', 'Uneta količina je veća od one koju radnik poseduje!', 'The amount entered is greater than the one the worker has!', 'Унета Количина је већа од oне коју Радник поседује!'),
(187, '', 'Revers', 'Revers', 'Реверс'),
(188, '', 'Razdužena količina uspešno smeštena u magacinu br.', 'Extended quantity successfully placed in the warehouse No.', 'Раздужена количина успешно смештена у магацину бр.'),
(189, '', 'Količina uspešno razdužena!', 'Quantity successfully extended!', 'Количина успешно раздужена!'),
(190, '', 'Izaberite grupu proizvoda', 'Select a product group', 'Изаберите групу производа'),
(191, '', 'Unos novih količina proizvoda', 'Entering new quantities of products', 'Унос нове количине производа'),
(192, '', 'Upis novog dobavljača', 'New Supplier Enrollment', 'Упис новог добављача'),
(193, '', 'Izaberite dobavljača', 'Select Supplier', 'Изаберите добављача'),
(194, '', 'Unesite naziv dobavljača', 'Enter the name of the supplier', 'Унесите назив добављача'),
(195, '', 'Uspešno unet novi dobavljač!', 'New supplier successfully entered!', 'Успешно унет нови добављач!'),
(196, '', 'Uspešno uneta količina proizvoda!', 'Product quantity successfully entered!', 'Успешно унета количина производа!'),
(197, '', 'Nekorektan unos količine proizvoda!', 'Incorrect product quantity input!', 'Некоректан Унос количине производа!'),
(198, '', 'Statistika dobavljača', 'Supplier statistics', 'Статистика добављача'),
(199, '', 'Žiralne uplate', 'Bank Transfer payments', 'Жиралнe уплатe'),
(200, '', 'Ukupno za dobavljača', 'Total for the supplier', 'Укупно за добављача'),
(201, '', 'Otpis', 'Write-off', 'Отпис'),
(202, '', 'Datum prodaje', 'Date of sale', 'Датум продаје'),
(203, '', 'Proizvod', 'Product', 'Производ'),
(204, '', 'Istorija zaduženja radnika', 'Employee Debt History', 'Историја задужења радника'),
(205, '', 'Izaberite početni datum:', 'Choose start date:', 'Изаберите почетни датум:'),
(206, '', 'Izaberite krajnji datum:', 'Choose end date:', 'Изаберите крајњи датум:'),
(207, '', 'za period', 'for period', 'за период'),
(208, '', 'Povežite kupce (opciono)', 'Connect Customers (Optional)', 'Повежите купце (опционо)'),
(209, '', 'Povezan sa kupcem', 'Connected to the customer', 'Повезан са купцем'),
(210, '', 'Iznos za razduženje', 'The amount for the deleveraging', 'Износ за раздужење'),
(211, '', 'pakovanja', 'packages', 'паковања'),
(212, '', 'Fakture', 'Invoices', 'Фактуре'),
(213, '', 'Isplate dobavljačima', 'Payments to suppliers', 'Исплате добављачима'),
(214, '', 'Razduženje reversa', 'Reverse discharge', 'Раздужење реверса'),
(215, '', 'Bilans stanja', 'Balance Sheet', 'Биланс стања'),
(216, '', 'Potražuje', 'Credit', 'Потражује'),
(217, '', 'Duguje', 'Debt', 'Дугује'),
(218, '', 'Stanje', 'Account balance', 'Стање'),
(219, '', 'Proizvodna cena', 'Production price', 'Производна цена'),
(220, '', 'Saldo', 'Total', 'Салдо'),
(221, '', 'Naplata reversa', 'Billing of the reverse', 'Наплата реверса'),
(222, '', 'Uplata evidentirana!', 'Payment recorded!', 'Уплата евидентирана!'),
(223, '', 'Pregled svih uplata', 'View all payments', 'Преглед свих уплата'),
(224, '', 'Traženi podaci ne postoje u bazi!', 'The requested information does not exist in the database!', 'Тражени подаци не постоје у бази!'),
(225, '', 'Realizacija fakture', 'Invoice realization', 'Реализација фактуре'),
(226, '', 'Da li ste sigurni u predstojeću radnju?', 'Are you shure about the upcoming action?', 'Да ли сте сигурни у предстојећу радњу?'),
(227, '', 'Isplaćeno', 'Paid', 'Исплаћено'),
(228, '', 'Ukupno dugovanje', 'Total debt', 'Укупно дуговање'),
(229, '', 'Obračun plata radnika', 'Workers'' wages calculation', 'Обрачун плата радника'),
(230, '', 'Neispravan unos perioda!', 'Invalid input period!', 'Неисправан унос периодa!'),
(231, '', 'Iznos za isplatu', 'Amount to pay off', 'Износ за исплату'),
(232, '', 'Poslednja isplata', 'Last payment', 'Последња исплата'),
(233, '', 'izvršena dana', 'made on', 'извршена дана'),
(234, '', 'U izabranom periodu radnik nije imao transakcije!', 'The employee had no transactions in the selected period!', 'У изабраном периоду радник није имао трансакције!'),
(235, '', 'Keš uplate', 'Cash payments', 'Кеш уплате'),
(236, '', 'Istorija platnih listi', 'Payroll history', 'Историја платних листи'),
(237, '', 'Zamena', 'Replacement', 'Замена'),
(238, '', 'Faktura realizovana!', 'Invoice realized!', 'Фактура реализована!'),
(239, '', 'Storno uplate', 'Cancellation of payment', 'Сторно уплате'),
(240, '', 'Transakcija stornirana!', 'Transaction canceled!', 'Трансакција сторнирана!'),
(241, '', 'Avans', 'Advance', 'Аванс'),
(242, '', 'Za dobavljače', 'For suppliers', 'За добављаче'),
(243, '', 'Istorija transakcija', 'Transaction history', 'Историја трансакција'),
(244, '', 'Lokalitet', 'Locality', 'Локалитет'),
(245, '', 'Ukoliko ne unesete datume, izlistaće se cela istorija transakcija!', 'If you do not enter the dates, list of the full history of transactions will be shown!', 'Ако не унесете датуме, излистаће се цела историја трансакција!'),
(246, '', 'Otpis evidentiran!', 'Write-off recorded!', 'Отпис евидентиран!'),
(247, '', 'Naplata evidentirana!', 'Billing recorded!', 'Наплата евидентирана!'),
(248, '', 'Pregled otpisanih proizvoda', 'Review of written-off products', 'Списак отписаних производа');

-- --------------------------------------------------------

--
-- Table structure for table `kolicinedobavljaca`
--

CREATE TABLE `kolicinedobavljaca` (
  `id` int(11) NOT NULL,
  `dobavljac` int(11) NOT NULL,
  `proizvod` int(11) NOT NULL,
  `kolicina` decimal(9,3) NOT NULL,
  `tezina_pakovanja` decimal(8,3) NOT NULL,
  `pakovanje` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kupac_zaduzenje`
--

CREATE TABLE `kupac_zaduzenje` (
  `id` int(6) NOT NULL,
  `datum` date NOT NULL,
  `radnik_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kupci`
--

CREATE TABLE `kupci` (
  `id` int(6) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `ulica` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `broj` int(6) NOT NULL,
  `PIB` bigint(20) NOT NULL,
  `racun` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `kupac_id` int(6) NOT NULL,
  `grupa_kupac` int(11) NOT NULL,
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `kupci`
--

INSERT INTO `kupci` (`id`, `naziv`, `grad`, `ulica`, `broj`, `PIB`, `racun`, `created_at`, `updated_at`, `kupac_id`, `grupa_kupac`, `aktivan`) VALUES
(1, 'Impex promet', 'Niš', 'Tolstojeva', 55, 109456789, '200-4179447-95', '2019-04-21', '2019-04-21', 1, 0, 1),
(2, 'Metro', 'Niš', '', 0, 0, '', '2019-09-10', '2019-09-10', 2, 0, 1),
(3, 'As trgovina', 'NIš', 'Somborska', 47, 108123456, '105-1234567-89', '2019-04-22', '2019-05-31', 3, 0, 1),
(4, 'Tempo', '', '', 0, 0, '', '2019-09-10', '2019-09-10', 4, 0, 1),
(7, 'Tempo 2', '', '', 0, 0, '', '2019-09-10', '2019-09-10', 7, 4, 1),
(8, 'Roda', 'Nis', '', 0, 0, '', '2019-09-17', '2019-09-17', 8, 0, 1),
(9, 'As trgovina Prvomajska', 'Niš', 'Prvomajska', 1, 108123456, '105-1234567-89', '2019-10-16', '2019-10-16', 9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kupci_uplata`
--

CREATE TABLE `kupci_uplata` (
  `id` int(11) NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `nacin` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kupci_ziralna_uplata`
--

CREATE TABLE `kupci_ziralna_uplata` (
  `id` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `nacin` int(11) NOT NULL DEFAULT '2',
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logovi`
--

CREATE TABLE `logovi` (
  `id` int(6) NOT NULL,
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `llog` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logovi`
--

INSERT INTO `logovi` (`id`, `login`, `logout`, `llog`) VALUES
(1, '2019-08-29 19:46:08', '0000-00-00 00:00:00', 8),
(2, '2019-08-29 19:46:17', '0000-00-00 00:00:00', 8),
(3, '2019-08-29 19:50:10', '0000-00-00 00:00:00', 8),
(4, '2019-08-29 19:58:54', '0000-00-00 00:00:00', 8),
(5, '2019-08-29 20:13:12', '0000-00-00 00:00:00', 8),
(6, '2019-08-29 20:44:01', '0000-00-00 00:00:00', 8),
(7, '2019-08-29 20:51:29', '0000-00-00 00:00:00', 8),
(8, '2019-08-29 21:05:01', '0000-00-00 00:00:00', 8),
(9, '2019-08-30 06:01:48', '0000-00-00 00:00:00', 8),
(10, '2019-08-30 10:57:36', '0000-00-00 00:00:00', 8),
(11, '2019-08-30 11:21:38', '0000-00-00 00:00:00', 8),
(12, '2019-08-30 12:56:32', '0000-00-00 00:00:00', 8),
(13, '2019-08-30 13:03:34', '0000-00-00 00:00:00', 8),
(14, '2019-08-30 14:24:21', '0000-00-00 00:00:00', 8),
(15, '2019-08-30 20:17:43', '0000-00-00 00:00:00', 8),
(16, '2019-08-30 20:18:32', '0000-00-00 00:00:00', 8),
(17, '2019-08-30 21:25:40', '0000-00-00 00:00:00', 8),
(18, '2019-08-30 21:52:19', '0000-00-00 00:00:00', 8),
(19, '2019-08-30 21:55:22', '0000-00-00 00:00:00', 8),
(20, '2019-08-30 22:11:54', '0000-00-00 00:00:00', 8),
(21, '2019-08-31 08:34:35', '0000-00-00 00:00:00', 8),
(22, '2019-08-31 13:19:57', '0000-00-00 00:00:00', 8),
(23, '2019-09-02 12:36:09', '0000-00-00 00:00:00', 8),
(24, '2019-09-02 14:32:39', '0000-00-00 00:00:00', 8),
(25, '2019-09-02 14:37:03', '0000-00-00 00:00:00', 8),
(26, '2019-09-02 14:37:35', '0000-00-00 00:00:00', 1),
(27, '2019-09-02 14:38:58', '0000-00-00 00:00:00', 1),
(28, '2019-09-02 15:28:14', '0000-00-00 00:00:00', 8),
(29, '2019-09-02 19:28:28', '0000-00-00 00:00:00', 1),
(30, '2019-09-02 20:55:35', '0000-00-00 00:00:00', 8),
(31, '2019-09-02 21:40:39', '0000-00-00 00:00:00', 1),
(32, '2019-09-02 21:42:16', '0000-00-00 00:00:00', 1),
(33, '2019-09-02 21:47:50', '0000-00-00 00:00:00', 1),
(34, '2019-09-03 05:56:57', '0000-00-00 00:00:00', 8),
(35, '2019-09-03 05:56:59', '0000-00-00 00:00:00', 8),
(36, '2019-09-03 05:59:10', '0000-00-00 00:00:00', 1),
(37, '2019-09-03 05:59:52', '0000-00-00 00:00:00', 8),
(38, '2019-09-03 06:05:04', '0000-00-00 00:00:00', 8),
(39, '2019-09-03 06:14:23', '0000-00-00 00:00:00', 8),
(40, '2019-09-03 06:36:18', '0000-00-00 00:00:00', 1),
(41, '2019-09-03 06:47:27', '0000-00-00 00:00:00', 1),
(42, '2019-09-03 07:08:38', '0000-00-00 00:00:00', 1),
(43, '2019-09-03 07:09:52', '0000-00-00 00:00:00', 1),
(44, '2019-09-03 07:13:54', '0000-00-00 00:00:00', 1),
(45, '2019-09-03 07:23:55', '0000-00-00 00:00:00', 1),
(46, '2019-09-03 08:42:24', '0000-00-00 00:00:00', 1),
(47, '2019-09-03 09:33:21', '0000-00-00 00:00:00', 1),
(48, '2019-09-03 09:40:33', '0000-00-00 00:00:00', 1),
(49, '2019-09-03 14:23:51', '0000-00-00 00:00:00', 1),
(50, '2019-09-03 22:23:37', '0000-00-00 00:00:00', 1),
(51, '2019-09-03 23:02:57', '0000-00-00 00:00:00', 8),
(52, '2019-09-03 23:03:25', '0000-00-00 00:00:00', 1),
(53, '2019-09-04 06:50:27', '0000-00-00 00:00:00', 1),
(54, '2019-09-04 06:54:59', '0000-00-00 00:00:00', 1),
(55, '2019-09-04 06:56:18', '0000-00-00 00:00:00', 1),
(56, '2019-09-04 08:11:10', '0000-00-00 00:00:00', 1),
(57, '2019-09-04 12:43:53', '0000-00-00 00:00:00', 1),
(58, '2019-09-04 19:00:42', '0000-00-00 00:00:00', 1),
(59, '2019-09-04 19:03:03', '0000-00-00 00:00:00', 1),
(60, '2019-09-04 19:03:54', '0000-00-00 00:00:00', 1),
(61, '2019-09-04 21:06:02', '0000-00-00 00:00:00', 1),
(62, '2019-09-04 21:53:48', '0000-00-00 00:00:00', 1),
(63, '2019-09-04 22:00:30', '0000-00-00 00:00:00', 1),
(64, '2019-09-04 22:32:45', '0000-00-00 00:00:00', 1),
(65, '2019-09-05 07:56:47', '0000-00-00 00:00:00', 1),
(66, '2019-09-05 11:52:17', '0000-00-00 00:00:00', 1),
(67, '2019-09-05 13:23:34', '0000-00-00 00:00:00', 1),
(68, '2019-09-05 13:23:53', '0000-00-00 00:00:00', 1),
(69, '2019-09-05 16:47:44', '0000-00-00 00:00:00', 1),
(70, '2019-09-05 17:51:11', '0000-00-00 00:00:00', 1),
(71, '2019-09-05 22:22:00', '0000-00-00 00:00:00', 1),
(72, '2019-09-05 23:12:20', '0000-00-00 00:00:00', 1),
(73, '2019-09-06 00:01:10', '0000-00-00 00:00:00', 1),
(74, '2019-09-06 00:32:23', '0000-00-00 00:00:00', 8),
(75, '2019-09-06 00:33:43', '0000-00-00 00:00:00', 1),
(76, '2019-09-06 01:17:50', '0000-00-00 00:00:00', 1),
(77, '2019-09-06 01:37:51', '0000-00-00 00:00:00', 1),
(78, '2019-09-06 11:15:10', '0000-00-00 00:00:00', 1),
(79, '2019-09-06 12:08:11', '0000-00-00 00:00:00', 8),
(80, '2019-09-06 12:11:00', '0000-00-00 00:00:00', 8),
(81, '2019-09-06 12:11:27', '0000-00-00 00:00:00', 8),
(82, '2019-09-06 14:02:19', '0000-00-00 00:00:00', 1),
(83, '2019-09-06 17:22:31', '0000-00-00 00:00:00', 1),
(84, '2019-09-07 06:59:37', '0000-00-00 00:00:00', 1),
(85, '2019-09-07 07:54:13', '0000-00-00 00:00:00', 8),
(86, '2019-09-07 07:58:17', '0000-00-00 00:00:00', 8),
(87, '2019-09-07 12:21:58', '0000-00-00 00:00:00', 8),
(88, '2019-09-07 13:41:00', '0000-00-00 00:00:00', 8),
(89, '2019-09-07 13:41:13', '0000-00-00 00:00:00', 8),
(90, '2019-09-07 13:55:38', '0000-00-00 00:00:00', 1),
(91, '2019-09-07 13:55:56', '0000-00-00 00:00:00', 8),
(92, '2019-09-07 17:10:33', '0000-00-00 00:00:00', 8),
(93, '2019-09-07 17:38:32', '0000-00-00 00:00:00', 8),
(94, '2019-09-07 23:46:19', '0000-00-00 00:00:00', 8),
(95, '2019-09-08 05:58:33', '0000-00-00 00:00:00', 8),
(96, '2019-09-08 18:30:33', '0000-00-00 00:00:00', 8),
(97, '2019-09-08 19:27:04', '0000-00-00 00:00:00', 8),
(98, '2019-09-09 06:55:49', '0000-00-00 00:00:00', 1),
(99, '2019-09-09 13:20:10', '0000-00-00 00:00:00', 8),
(100, '2019-09-09 15:57:29', '0000-00-00 00:00:00', 8),
(101, '2019-09-09 16:18:27', '0000-00-00 00:00:00', 1),
(102, '2019-09-09 19:58:17', '0000-00-00 00:00:00', 1),
(103, '2019-09-09 20:28:27', '0000-00-00 00:00:00', 1),
(104, '2019-09-09 21:22:07', '0000-00-00 00:00:00', 1),
(105, '2019-09-10 00:10:33', '0000-00-00 00:00:00', 1),
(106, '2019-09-10 07:01:08', '0000-00-00 00:00:00', 1),
(107, '2019-09-10 07:24:38', '0000-00-00 00:00:00', 1),
(108, '2019-09-10 07:50:54', '0000-00-00 00:00:00', 1),
(109, '2019-09-10 16:10:58', '0000-00-00 00:00:00', 8),
(110, '2019-09-10 16:24:45', '0000-00-00 00:00:00', 1),
(111, '2019-09-11 07:32:04', '0000-00-00 00:00:00', 1),
(112, '2019-09-11 07:43:20', '0000-00-00 00:00:00', 1),
(113, '2019-09-11 12:53:33', '0000-00-00 00:00:00', 1),
(114, '2019-09-11 18:52:15', '0000-00-00 00:00:00', 1),
(115, '2019-09-11 20:32:47', '0000-00-00 00:00:00', 1),
(116, '2019-09-12 06:48:00', '0000-00-00 00:00:00', 1),
(117, '2019-09-12 07:39:03', '0000-00-00 00:00:00', 8),
(118, '2019-09-12 07:39:29', '0000-00-00 00:00:00', 8),
(119, '2019-09-12 07:39:58', '0000-00-00 00:00:00', 8),
(120, '2019-09-12 07:40:47', '0000-00-00 00:00:00', 8),
(121, '2019-09-12 15:59:24', '0000-00-00 00:00:00', 1),
(122, '2019-09-12 22:57:25', '0000-00-00 00:00:00', 8),
(123, '2019-09-12 23:00:16', '0000-00-00 00:00:00', 8),
(124, '2019-09-13 07:41:18', '0000-00-00 00:00:00', 8),
(125, '2019-09-13 09:30:06', '0000-00-00 00:00:00', 1),
(126, '2019-09-13 12:05:42', '0000-00-00 00:00:00', 8),
(127, '2019-09-13 12:05:55', '0000-00-00 00:00:00', 1),
(128, '2019-09-13 12:51:37', '0000-00-00 00:00:00', 1),
(129, '2019-09-14 03:09:18', '0000-00-00 00:00:00', 1),
(130, '2019-09-14 10:03:36', '0000-00-00 00:00:00', 8),
(131, '2019-09-14 12:47:37', '0000-00-00 00:00:00', 1),
(132, '2019-09-14 12:53:15', '0000-00-00 00:00:00', 8),
(133, '2019-09-14 13:10:49', '0000-00-00 00:00:00', 1),
(134, '2019-09-15 07:05:54', '0000-00-00 00:00:00', 8),
(135, '2019-09-15 07:22:28', '0000-00-00 00:00:00', 8),
(136, '2019-09-15 11:12:36', '0000-00-00 00:00:00', 8),
(137, '2019-09-15 13:32:14', '0000-00-00 00:00:00', 1),
(138, '2019-09-15 14:13:48', '0000-00-00 00:00:00', 1),
(139, '2019-09-15 14:58:05', '0000-00-00 00:00:00', 1),
(140, '2019-09-15 15:25:08', '0000-00-00 00:00:00', 1),
(141, '2019-09-15 23:07:00', '0000-00-00 00:00:00', 1),
(142, '2019-09-15 23:19:27', '0000-00-00 00:00:00', 8),
(143, '2019-09-16 06:40:37', '0000-00-00 00:00:00', 1),
(144, '2019-09-16 07:04:54', '0000-00-00 00:00:00', 1),
(145, '2019-09-16 07:06:18', '0000-00-00 00:00:00', 1),
(146, '2019-09-16 08:02:37', '0000-00-00 00:00:00', 1),
(147, '2019-09-16 08:53:20', '0000-00-00 00:00:00', 1),
(148, '2019-09-16 09:33:14', '0000-00-00 00:00:00', 1),
(149, '2019-09-16 09:47:08', '0000-00-00 00:00:00', 1),
(150, '2019-09-16 10:08:49', '0000-00-00 00:00:00', 1),
(151, '2019-09-16 10:56:12', '0000-00-00 00:00:00', 1),
(152, '2019-09-16 11:51:15', '0000-00-00 00:00:00', 1),
(153, '2019-09-16 11:53:13', '0000-00-00 00:00:00', 1),
(154, '2019-09-16 11:53:52', '0000-00-00 00:00:00', 1),
(155, '2019-09-16 11:56:40', '0000-00-00 00:00:00', 1),
(156, '2019-09-16 12:09:10', '0000-00-00 00:00:00', 1),
(157, '2019-09-16 15:33:51', '0000-00-00 00:00:00', 1),
(158, '2019-09-16 16:39:50', '0000-00-00 00:00:00', 1),
(159, '2019-09-16 19:05:26', '0000-00-00 00:00:00', 1),
(160, '2019-09-16 22:45:41', '0000-00-00 00:00:00', 1),
(161, '2019-09-16 23:35:47', '0000-00-00 00:00:00', 1),
(162, '2019-09-17 00:41:36', '0000-00-00 00:00:00', 1),
(163, '2019-09-17 07:53:53', '0000-00-00 00:00:00', 1),
(164, '2019-09-17 07:56:25', '0000-00-00 00:00:00', 8),
(165, '2019-09-17 11:00:09', '0000-00-00 00:00:00', 1),
(166, '2019-09-17 11:38:13', '0000-00-00 00:00:00', 1),
(167, '2019-09-17 11:40:59', '0000-00-00 00:00:00', 1),
(168, '2019-09-17 12:06:32', '0000-00-00 00:00:00', 1),
(169, '2019-09-17 12:43:06', '0000-00-00 00:00:00', 1),
(170, '2019-09-17 12:48:20', '0000-00-00 00:00:00', 1),
(171, '2019-09-17 13:15:15', '0000-00-00 00:00:00', 8),
(172, '2019-09-17 15:02:53', '0000-00-00 00:00:00', 1),
(173, '2019-09-17 17:34:24', '0000-00-00 00:00:00', 1),
(174, '2019-09-17 20:25:38', '0000-00-00 00:00:00', 8),
(175, '2019-09-18 07:57:50', '0000-00-00 00:00:00', 1),
(176, '2019-09-18 10:59:00', '0000-00-00 00:00:00', 1),
(177, '2019-09-18 11:09:55', '0000-00-00 00:00:00', 1),
(178, '2019-09-18 11:11:38', '0000-00-00 00:00:00', 1),
(179, '2019-09-18 11:13:18', '0000-00-00 00:00:00', 1),
(180, '2019-09-18 11:15:48', '0000-00-00 00:00:00', 1),
(181, '2019-09-18 11:19:01', '0000-00-00 00:00:00', 1),
(182, '2019-09-18 12:23:44', '0000-00-00 00:00:00', 1),
(183, '2019-09-18 12:31:07', '0000-00-00 00:00:00', 8),
(184, '2019-09-18 12:32:37', '0000-00-00 00:00:00', 1),
(185, '2019-09-18 19:53:26', '0000-00-00 00:00:00', 1),
(186, '2019-09-19 17:33:10', '0000-00-00 00:00:00', 1),
(187, '2019-09-19 18:11:04', '0000-00-00 00:00:00', 1),
(188, '2019-09-19 18:12:41', '0000-00-00 00:00:00', 1),
(189, '2019-09-20 00:41:59', '0000-00-00 00:00:00', 1),
(190, '2019-09-20 12:22:01', '0000-00-00 00:00:00', 1),
(191, '2019-09-23 16:14:27', '0000-00-00 00:00:00', 1),
(192, '2019-09-23 16:20:05', '0000-00-00 00:00:00', 1),
(193, '2019-09-23 19:24:04', '0000-00-00 00:00:00', 1),
(194, '2019-09-24 19:29:45', '0000-00-00 00:00:00', 1),
(195, '2019-09-24 20:37:38', '0000-00-00 00:00:00', 1),
(196, '2019-09-25 07:55:12', '0000-00-00 00:00:00', 1),
(197, '2019-09-25 11:25:22', '0000-00-00 00:00:00', 1),
(198, '2019-09-25 21:21:40', '0000-00-00 00:00:00', 1),
(199, '2019-09-26 10:25:12', '0000-00-00 00:00:00', 1),
(200, '2019-09-26 14:50:06', '0000-00-00 00:00:00', 1),
(201, '2019-09-26 15:55:55', '0000-00-00 00:00:00', 1),
(202, '2019-09-26 23:15:58', '0000-00-00 00:00:00', 1),
(203, '2019-09-27 06:29:44', '0000-00-00 00:00:00', 1),
(204, '2019-09-27 07:49:11', '0000-00-00 00:00:00', 1),
(205, '2019-09-27 07:55:34', '0000-00-00 00:00:00', 1),
(206, '2019-09-27 09:28:50', '0000-00-00 00:00:00', 1),
(207, '2019-09-27 10:20:00', '0000-00-00 00:00:00', 1),
(208, '2019-09-27 12:24:19', '0000-00-00 00:00:00', 1),
(209, '2019-09-27 12:36:41', '0000-00-00 00:00:00', 1),
(210, '2019-09-27 15:16:53', '0000-00-00 00:00:00', 1),
(211, '2019-09-28 00:08:29', '0000-00-00 00:00:00', 1),
(212, '2019-09-28 07:41:31', '0000-00-00 00:00:00', 1),
(213, '2019-09-28 12:20:02', '0000-00-00 00:00:00', 1),
(214, '2019-09-28 12:33:04', '0000-00-00 00:00:00', 1),
(215, '2019-09-28 15:42:02', '0000-00-00 00:00:00', 1),
(216, '2019-09-28 23:06:24', '0000-00-00 00:00:00', 1),
(217, '2019-09-28 23:47:35', '0000-00-00 00:00:00', 1),
(218, '2019-09-29 05:38:25', '0000-00-00 00:00:00', 1),
(219, '2019-09-29 09:56:49', '0000-00-00 00:00:00', 1),
(220, '2019-09-29 10:02:01', '0000-00-00 00:00:00', 1),
(221, '2019-09-29 19:58:09', '0000-00-00 00:00:00', 1),
(222, '2019-09-29 22:08:39', '0000-00-00 00:00:00', 1),
(223, '2019-09-29 22:10:31', '0000-00-00 00:00:00', 1),
(224, '2019-09-30 06:23:21', '0000-00-00 00:00:00', 1),
(225, '2019-09-30 06:44:07', '0000-00-00 00:00:00', 1),
(226, '2019-09-30 13:55:00', '0000-00-00 00:00:00', 1),
(227, '2019-09-30 15:28:52', '0000-00-00 00:00:00', 1),
(228, '2019-09-30 15:34:21', '0000-00-00 00:00:00', 8),
(229, '2019-09-30 16:34:09', '0000-00-00 00:00:00', 1),
(230, '2019-09-30 16:36:55', '0000-00-00 00:00:00', 1),
(231, '2019-09-30 18:51:18', '0000-00-00 00:00:00', 1),
(232, '2019-09-30 19:29:45', '0000-00-00 00:00:00', 1),
(233, '2019-09-30 20:37:31', '0000-00-00 00:00:00', 1),
(234, '2019-09-30 20:38:53', '0000-00-00 00:00:00', 1),
(235, '2019-09-30 20:40:22', '0000-00-00 00:00:00', 1),
(236, '2019-10-01 06:25:31', '0000-00-00 00:00:00', 1),
(237, '2019-10-01 11:05:50', '0000-00-00 00:00:00', 1),
(238, '2019-10-01 21:27:08', '0000-00-00 00:00:00', 1),
(239, '2019-10-01 22:13:55', '0000-00-00 00:00:00', 8),
(240, '2019-10-01 23:32:09', '0000-00-00 00:00:00', 1),
(241, '2019-10-02 05:45:31', '0000-00-00 00:00:00', 8),
(242, '2019-10-02 05:46:58', '0000-00-00 00:00:00', 1),
(243, '2019-10-10 07:25:27', '0000-00-00 00:00:00', 1),
(244, '2019-10-10 12:46:56', '0000-00-00 00:00:00', 1),
(245, '2019-10-10 12:53:04', '0000-00-00 00:00:00', 1),
(246, '2019-10-10 13:02:36', '0000-00-00 00:00:00', 1),
(247, '2019-10-10 14:02:30', '0000-00-00 00:00:00', 1),
(248, '2019-10-10 18:53:15', '0000-00-00 00:00:00', 1),
(249, '2019-10-10 19:43:36', '0000-00-00 00:00:00', 1),
(250, '2019-10-09 20:01:02', '0000-00-00 00:00:00', 8),
(251, '2019-10-09 20:34:21', '0000-00-00 00:00:00', 1),
(252, '2019-10-10 20:37:57', '0000-00-00 00:00:00', 1),
(253, '2019-10-10 21:02:21', '0000-00-00 00:00:00', 8),
(254, '2019-10-11 06:25:32', '0000-00-00 00:00:00', 1),
(255, '2019-10-11 09:31:10', '0000-00-00 00:00:00', 1),
(256, '2019-10-11 09:58:45', '0000-00-00 00:00:00', 8),
(257, '2019-10-11 10:46:02', '0000-00-00 00:00:00', 8),
(258, '2019-10-12 07:00:57', '0000-00-00 00:00:00', 1),
(259, '2019-10-12 08:50:36', '0000-00-00 00:00:00', 1),
(260, '2019-10-12 08:55:38', '0000-00-00 00:00:00', 8),
(261, '2019-10-13 08:07:34', '0000-00-00 00:00:00', 1),
(262, '2019-10-13 08:08:28', '0000-00-00 00:00:00', 1),
(263, '2019-10-13 11:09:32', '0000-00-00 00:00:00', 1),
(264, '2019-10-13 15:48:07', '0000-00-00 00:00:00', 8),
(265, '2019-10-15 05:36:16', '0000-00-00 00:00:00', 8),
(266, '2019-10-15 05:36:28', '0000-00-00 00:00:00', 1),
(267, '2019-10-15 08:31:05', '0000-00-00 00:00:00', 1),
(268, '2019-10-15 08:31:33', '0000-00-00 00:00:00', 1),
(269, '2019-10-15 08:32:10', '0000-00-00 00:00:00', 1),
(270, '2019-10-15 17:08:49', '0000-00-00 00:00:00', 1),
(271, '2019-10-15 20:26:16', '0000-00-00 00:00:00', 1),
(272, '2019-10-15 22:14:00', '0000-00-00 00:00:00', 1),
(273, '2019-10-16 05:47:55', '0000-00-00 00:00:00', 1),
(274, '2019-10-16 05:48:00', '0000-00-00 00:00:00', 1),
(275, '2019-10-16 16:16:04', '0000-00-00 00:00:00', 1),
(276, '2019-10-16 20:40:46', '0000-00-00 00:00:00', 8),
(277, '2019-10-17 11:45:44', '0000-00-00 00:00:00', 1),
(278, '2019-10-17 12:34:36', '0000-00-00 00:00:00', 1),
(279, '2019-10-17 12:34:59', '0000-00-00 00:00:00', 1),
(280, '2019-10-17 18:56:01', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lozinke`
--

CREATE TABLE `lozinke` (
  `lozinke_id` int(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `aktivan` int(2) NOT NULL DEFAULT '1',
  `rola` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lozinke`
--

INSERT INTO `lozinke` (`lozinke_id`, `password`, `login`, `aktivan`, `rola`) VALUES
(1, 'pecurka', 'darko', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2019_08_03_103153_create_veza_table', 1),
('2019_08_06_203155_create_zaduzenjeVeza_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `obj`
--

CREATE TABLE `obj` (
  `id` int(11) NOT NULL,
  `y` int(6) NOT NULL,
  `label` varchar(255) NOT NULL,
  `gdp` decimal(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otpis`
--

CREATE TABLE `otpis` (
  `id` int(11) NOT NULL,
  `proizvod` int(11) NOT NULL,
  `kupac` int(11) NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `opis` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ovlascenja`
--

CREATE TABLE `ovlascenja` (
  `id` int(6) NOT NULL,
  `naziv_ovlascenja` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `nivo_ovlascenja` int(6) NOT NULL,
  `ovlascenje_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ovlascenja`
--

INSERT INTO `ovlascenja` (`id`, `naziv_ovlascenja`, `nivo_ovlascenja`, `ovlascenje_id`) VALUES
(1, 'Direktor', 10, 1),
(2, 'Poslovođa', 1, 2),
(3, 'Radnik', 3, 3),
(4, 'Pomoćni radnik', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plate_radnika`
--

CREATE TABLE `plate_radnika` (
  `id` int(11) NOT NULL,
  `radnik` int(11) NOT NULL,
  `period_od` date NOT NULL,
  `period_do` date NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privremena_tabela`
--

CREATE TABLE `privremena_tabela` (
  `id` int(6) NOT NULL,
  `radnik` int(6) NOT NULL,
  `kupac` int(6) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `kolicina` decimal(10,2) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `zarRad` decimal(10,2) NOT NULL DEFAULT '0.00',
  `proizvod_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privremena_tabela`
--

INSERT INTO `privremena_tabela` (`id`, `radnik`, `kupac`, `created_at`, `updated_at`, `kolicina`, `cena`, `zarRad`, `proizvod_id`) VALUES
(1, 1, 1, '2019-08-11', '2019-08-11', '0.00', '0.00', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privremeni_proizvod`
--

CREATE TABLE `privremeni_proizvod` (
  `id` int(6) NOT NULL,
  `proizvod_id` int(6) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(6) UNSIGNED NOT NULL,
  `naziv_proizvoda` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `grupa_proizvoda` int(6) NOT NULL,
  `cena_proizvoda` decimal(10,2) NOT NULL,
  `proizvodna_cena` decimal(10,2) NOT NULL,
  `kolicina_proizvoda` decimal(8,3) NOT NULL DEFAULT '0.000',
  `kolicina_pocetak` decimal(10,3) NOT NULL,
  `tezina_pakovanja` decimal(8,3) NOT NULL,
  `pakovanje` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `magacin` int(11) NOT NULL DEFAULT '0',
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv_proizvoda`, `grupa_proizvoda`, `cena_proizvoda`, `proizvodna_cena`, `kolicina_proizvoda`, `kolicina_pocetak`, `tezina_pakovanja`, `pakovanje`, `created_at`, `updated_at`, `magacin`, `aktivan`) VALUES
(1, 'Paradajz', 2, '85.00', '60.00', '0.000', '0.000', '0.000', 0, '2019-04-26', '2019-09-08', 0, 1),
(13, 'Jabuka', 3, '59.00', '40.00', '0.000', '0.000', '0.000', 0, '2019-04-26', '2019-09-05', 0, 1),
(17, 'Paprika', 2, '17.00', '11.00', '0.000', '0.000', '0.000', 0, '2019-04-26', '2019-09-05', 0, 1),
(18, 'Šampinjon', 1, '82.00', '54.00', '0.000', '0.000', '0.000', 0, '2019-04-26', '2019-10-17', 0, 1),
(20, 'Kruška', 3, '155.00', '105.00', '0.000', '0.000', '0.000', 0, '2019-04-27', '2019-09-05', 0, 1),
(21, 'Dunja', 3, '24.00', '16.00', '0.000', '0.000', '0.000', 0, '2019-05-13', '2019-09-10', 0, 0),
(23, 'Grožđe', 3, '18.00', '12.00', '0.000', '0.000', '0.000', 0, '2019-05-13', '2019-09-05', 0, 1),
(24, 'Bukovača', 3, '120.00', '95.00', '0.000', '0.000', '0.000', 0, '2019-05-13', '2019-10-17', 0, 1),
(25, 'Banana', 3, '100.00', '67.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-09-16', 0, 0),
(26, 'Vrganj', 4, '250.00', '195.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-10-16', 0, 1),
(27, 'Lisičara', 3, '185.00', '140.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-10-11', 0, 1),
(28, 'Limun', 3, '75.00', '50.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-09-16', 0, 0),
(29, 'Ananas', 3, '150.00', '100.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-09-16', 0, 0),
(30, 'Narandža', 3, '65.00', '43.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-09-05', 0, 1),
(31, 'Urme', 3, '450.00', '300.00', '0.000', '0.000', '0.000', 0, '2019-07-29', '2019-09-05', 0, 1),
(33, 'Kajsija', 3, '55.00', '35.00', '0.000', '0.000', '0.000', 0, '2019-08-03', '2019-09-05', 0, 1),
(44, 'Šampinjon 0,700', 1, '300.00', '200.00', '0.000', '0.000', '0.700', 0, '2019-09-11', '2019-10-17', 0, 1),
(45, 'Šampinjoni 0,350', 1, '200.00', '135.00', '0.000', '0.000', '0.350', 0, '2019-09-12', '2019-10-15', 0, 1),
(46, 'Vrganj 0,350', 4, '90.00', '65.00', '0.000', '0.000', '0.350', 0, '2019-09-15', '2019-10-13', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `radnici`
--

CREATE TABLE `radnici` (
  `id` int(6) UNSIGNED NOT NULL,
  `ime` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `prezime` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `ulica` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `broj` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `jmbg` varchar(13) COLLATE utf8_croatian_ci NOT NULL,
  `brlk` bigint(25) NOT NULL,
  `pu` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `nacin_zarade` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nacin_zarade1` decimal(5,2) DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `rola` int(6) NOT NULL DEFAULT '3',
  `radnici_id` int(11) NOT NULL,
  `veza_id` int(10) UNSIGNED NOT NULL,
  `aktivan` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `radnici`
--

INSERT INTO `radnici` (`id`, `ime`, `lozinka`, `prezime`, `grad`, `ulica`, `broj`, `jmbg`, `brlk`, `pu`, `nacin_zarade`, `nacin_zarade1`, `status`, `created_at`, `updated_at`, `rola`, `radnici_id`, `veza_id`, `aktivan`) VALUES
(1, 'Darko', 'pecurka', 'Petković', 'Laktaši', 'Banjalučka', 'bb', '0804974730056', 12345678, 'PU Banja Luka', '80000.00', '0.07', 1, '0000-00-00', '2019-05-31', 10, 0, 0, 1),
(8, 'Boban', 'Boba', 'Petković', 'Niš', 'Somborska', '57/18', '1001971730056', 4882630, 'PU Niš', '50000.00', '0.03', 1, '2019-04-04', '2019-05-31', 1, 0, 0, 1),
(10, 'Jovan', 'Jova', 'Petković', 'Niš', 'Somborska', '57/18', '0803001730026', 1111111, 'PU Niš', '50000.00', '0.05', 1, '2019-04-04', '2019-08-03', 1, 0, 0, 1),
(12, 'Rajka', 'Rajk', 'Petković', 'Plav', 'Limski most', 'bb', '1910969735024', 123456, 'PU Niš', '50000.00', '0.01', 1, '2019-04-20', '2019-08-03', 3, 0, 0, 1),
(14, 'Ivan', 'Iva', 'Stojanović ', 'Niš', 'Gornjomatejevačka', '78', '0101974730023', 482631, 'PU Niš', '43000.00', '0.03', 2, '2019-04-26', '2019-08-03', 4, 0, 0, 1),
(15, 'Branko', '11111', 'Kačar', 'Niš', 'Gornjematejevačka', '9', '0405970730056', 546879321, 'PU Niš', '45000.00', '0.06', 2, '2019-05-30', '2019-09-30', 2, 0, 0, 1),
(16, 'Zdravko', '22222', 'Vintar', 'Niš', 'Donja Vrežina', '54', '1512959546213', 5487963, 'PU Priština', '65000.00', '0.00', 1, '2019-05-30', '2019-05-30', 2, 0, 0, 1),
(19, 'Miloš', 'milo', 'Spasić', 'Niš', 'Milene Dravić', '5', '1211971730023', 45678945, 'PU Niš', '65000.00', '0.00', 1, '2019-08-02', '2019-08-02', 3, 0, 0, 1),
(21, 'Žika', NULL, 'Žikić', 'dy', 'kjlm,', '8', '6465454', 6545, 'da', '25000.00', '0.00', 1, '2019-08-03', '2019-09-10', 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `radnik_lista_zaduzenja`
--

CREATE TABLE `radnik_lista_zaduzenja` (
  `id` int(6) NOT NULL,
  `kupac_id` int(6) NOT NULL,
  `stavka_id` int(6) NOT NULL,
  `kolicina` int(6) NOT NULL,
  `racun` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `radnik_zaduzenje_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `radnik_zaduzenje`
--

CREATE TABLE `radnik_zaduzenje` (
  `id` int(6) NOT NULL,
  `radnik_id` int(6) NOT NULL,
  `datum` date NOT NULL,
  `radnik_zaduzenje_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `radnik_zarada`
--

CREATE TABLE `radnik_zarada` (
  `id` int(6) NOT NULL,
  `sifra_nacina_zarade` int(6) NOT NULL,
  `procenat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zarada_racun` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zarada_bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `radnik_zarada_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `razduzenjeradnika`
--

CREATE TABLE `razduzenjeradnika` (
  `id` int(11) NOT NULL,
  `radnik` int(11) NOT NULL,
  `proizvod` int(11) NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `kupac` int(11) NOT NULL,
  `nacin` int(11) NOT NULL,
  `pakovanje` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `realiz_uplate` int(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `routes_id` int(6) NOT NULL,
  `route` varchar(255) NOT NULL,
  `permission` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`routes_id`, `route`, `permission`) VALUES
(1, 'http://local.pecurka/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ulazna_stavka`
--

CREATE TABLE `ulazna_stavka` (
  `ulazna_stavka_id` int(6) NOT NULL,
  `ulazna_stavka` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `ulazna_stavka_nabavna_cena` double(10,2) NOT NULL,
  `ulazna_stavka_porez` double(10,2) NOT NULL,
  `ulazna_stavka_zaracunata_marza` double(10,2) NOT NULL,
  `ulazna_stavka_dobavljac` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  `marker` int(6) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `ulazna_stavka`
--

INSERT INTO `ulazna_stavka` (`ulazna_stavka_id`, `ulazna_stavka`, `ulazna_stavka_nabavna_cena`, `ulazna_stavka_porez`, `ulazna_stavka_zaracunata_marza`, `ulazna_stavka_dobavljac`, `marker`, `created_at`, `updated_at`, `aktivan`) VALUES
(1, 'gdgf', 34.00, 20.00, 0.00, '', 0, '2019-09-10', '2019-09-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `upisaniproizvod`
--

CREATE TABLE `upisaniproizvod` (
  `id` int(6) NOT NULL,
  `radnik` int(6) NOT NULL,
  `proizvod` int(6) NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `kolicina2` decimal(8,3) NOT NULL,
  `radnik_id` int(6) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nacin` int(11) NOT NULL,
  `pakovanje` int(11) NOT NULL,
  `pakovanje2` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upisaniproizvod2`
--

CREATE TABLE `upisaniproizvod2` (
  `id` int(6) NOT NULL,
  `radnik` int(6) NOT NULL,
  `proizvod` int(6) NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `radnik_id` int(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veza`
--

CREATE TABLE `veza` (
  `id` int(10) UNSIGNED NOT NULL,
  `radnik` int(10) UNSIGNED NOT NULL,
  `proizvod` int(10) UNSIGNED NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `magacin` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `pakovanje` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_prodaje`
--

CREATE TABLE `vrsta_prodaje` (
  `id` int(11) NOT NULL,
  `naziv` int(11) NOT NULL,
  `nacin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vrsta_prodaje`
--

INSERT INTO `vrsta_prodaje` (`id`, `naziv`, `nacin`) VALUES
(1, 181, 1),
(2, 182, 2),
(3, 187, 3);

-- --------------------------------------------------------

--
-- Table structure for table `zaduzenjekupac`
--

CREATE TABLE `zaduzenjekupac` (
  `id` int(6) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `kupac_id` int(6) NOT NULL,
  `radnik_id` int(6) NOT NULL,
  `proizvod_id` int(6) NOT NULL,
  `kolicina` int(6) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `zarRad` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zaduzenjeKupac_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zaduzenjeveza`
--

CREATE TABLE `zaduzenjeveza` (
  `id` int(10) UNSIGNED NOT NULL,
  `radnik` int(10) UNSIGNED NOT NULL,
  `proizvod` int(10) UNSIGNED NOT NULL,
  `kolicina` decimal(8,3) NOT NULL,
  `kupac` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dobavljaci`
--
ALTER TABLE `dobavljaci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dobavljaci_isplata`
--
ALTER TABLE `dobavljaci_isplata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`firma_id`);

--
-- Indexes for table `grupa_proizvoda`
--
ALTER TABLE `grupa_proizvoda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grupa_id` (`grupa_id`),
  ADD UNIQUE KEY `naziv_grupe` (`naziv_grupe`);

--
-- Indexes for table `jezici`
--
ALTER TABLE `jezici`
  ADD PRIMARY KEY (`jezici_id`);

--
-- Indexes for table `kolicinedobavljaca`
--
ALTER TABLE `kolicinedobavljaca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupac_zaduzenje`
--
ALTER TABLE `kupac_zaduzenje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupci`
--
ALTER TABLE `kupci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupci_uplata`
--
ALTER TABLE `kupci_uplata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupci_ziralna_uplata`
--
ALTER TABLE `kupci_ziralna_uplata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logovi`
--
ALTER TABLE `logovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lozinke`
--
ALTER TABLE `lozinke`
  ADD PRIMARY KEY (`lozinke_id`);

--
-- Indexes for table `obj`
--
ALTER TABLE `obj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otpis`
--
ALTER TABLE `otpis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ovlascenja`
--
ALTER TABLE `ovlascenja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plate_radnika`
--
ALTER TABLE `plate_radnika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privremena_tabela`
--
ALTER TABLE `privremena_tabela`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privremeni_proizvod`
--
ALTER TABLE `privremeni_proizvod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `radnici`
--
ALTER TABLE `radnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jmbg` (`jmbg`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `radnik_lista_zaduzenja`
--
ALTER TABLE `radnik_lista_zaduzenja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radnik_zaduzenje`
--
ALTER TABLE `radnik_zaduzenje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radnik_zarada`
--
ALTER TABLE `radnik_zarada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razduzenjeradnika`
--
ALTER TABLE `razduzenjeradnika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`routes_id`);

--
-- Indexes for table `ulazna_stavka`
--
ALTER TABLE `ulazna_stavka`
  ADD PRIMARY KEY (`ulazna_stavka_id`);

--
-- Indexes for table `upisaniproizvod`
--
ALTER TABLE `upisaniproizvod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upisaniproizvod2`
--
ALTER TABLE `upisaniproizvod2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veza`
--
ALTER TABLE `veza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `veza_radnik_index` (`radnik`),
  ADD KEY `veza_proizvod_index` (`proizvod`);

--
-- Indexes for table `vrsta_prodaje`
--
ALTER TABLE `vrsta_prodaje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zaduzenjekupac`
--
ALTER TABLE `zaduzenjekupac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zaduzenjeveza`
--
ALTER TABLE `zaduzenjeveza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zaduzenjeveza_radnik_index` (`radnik`),
  ADD KEY `zaduzenjeveza_proizvod_index` (`proizvod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dobavljaci`
--
ALTER TABLE `dobavljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dobavljaci_isplata`
--
ALTER TABLE `dobavljaci_isplata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `firma`
--
ALTER TABLE `firma`
  MODIFY `firma_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `grupa_proizvoda`
--
ALTER TABLE `grupa_proizvoda`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jezici`
--
ALTER TABLE `jezici`
  MODIFY `jezici_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `kolicinedobavljaca`
--
ALTER TABLE `kolicinedobavljaca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kupac_zaduzenje`
--
ALTER TABLE `kupac_zaduzenje`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kupci`
--
ALTER TABLE `kupci`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kupci_uplata`
--
ALTER TABLE `kupci_uplata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kupci_ziralna_uplata`
--
ALTER TABLE `kupci_ziralna_uplata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logovi`
--
ALTER TABLE `logovi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;
--
-- AUTO_INCREMENT for table `lozinke`
--
ALTER TABLE `lozinke`
  MODIFY `lozinke_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `obj`
--
ALTER TABLE `obj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `otpis`
--
ALTER TABLE `otpis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ovlascenja`
--
ALTER TABLE `ovlascenja`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `plate_radnika`
--
ALTER TABLE `plate_radnika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privremena_tabela`
--
ALTER TABLE `privremena_tabela`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `privremeni_proizvod`
--
ALTER TABLE `privremeni_proizvod`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `radnici`
--
ALTER TABLE `radnici`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `radnik_lista_zaduzenja`
--
ALTER TABLE `radnik_lista_zaduzenja`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `radnik_zaduzenje`
--
ALTER TABLE `radnik_zaduzenje`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `radnik_zarada`
--
ALTER TABLE `radnik_zarada`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `razduzenjeradnika`
--
ALTER TABLE `razduzenjeradnika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `routes_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ulazna_stavka`
--
ALTER TABLE `ulazna_stavka`
  MODIFY `ulazna_stavka_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `upisaniproizvod`
--
ALTER TABLE `upisaniproizvod`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upisaniproizvod2`
--
ALTER TABLE `upisaniproizvod2`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veza`
--
ALTER TABLE `veza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vrsta_prodaje`
--
ALTER TABLE `vrsta_prodaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zaduzenjekupac`
--
ALTER TABLE `zaduzenjekupac`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zaduzenjeveza`
--
ALTER TABLE `zaduzenjeveza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `veza`
--
ALTER TABLE `veza`
  ADD CONSTRAINT `veza_proizvod_foreign` FOREIGN KEY (`proizvod`) REFERENCES `proizvodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `veza_radnik_foreign` FOREIGN KEY (`radnik`) REFERENCES `radnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zaduzenjeveza`
--
ALTER TABLE `zaduzenjeveza`
  ADD CONSTRAINT `zaduzenjeveza_proizvod_foreign` FOREIGN KEY (`proizvod`) REFERENCES `proizvodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zaduzenjeveza_radnik_foreign` FOREIGN KEY (`radnik`) REFERENCES `radnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
