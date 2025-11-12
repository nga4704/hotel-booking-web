-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 01, 2024 lúc 08:52 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookinghotel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `intro` text NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `intro`, `type`) VALUES
(1, 'Sona A Luxury Hotel', 'Here are the best hotel booking sites, including recommendations for international travel and for finding low-priced hotel rooms.', 1),
(2, 'Intercontinental LA\r\nWestlake Hotel', 'Sona.com is a leading online accommodation site. We’re passionate about travel. Every day, we inspire and reach millions of travelers across 90 local websites in 41 languages.\r\n\r\nSo when it comes to booking the perfect hotel, vacation rental, resort, apartment, guest house, or tree house, we’ve got you covered.', 2),
(3, 'Welcome To Sona.', 'Built in 1910 during the Belle Epoque period, this hotel is located in the center of Paris, with easy access to the city’s tourist attractions. It offers tastefully decorated rooms.', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `img`) VALUES
(1, 'admin', '123', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(2) NOT NULL,
  `timePost` varchar(255) NOT NULL,
  `timeUpdate` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `content`, `image`, `category_id`, `timePost`, `timeUpdate`, `status`) VALUES
(1, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-1.jpg', 1, '1703268849', '1703268849', 1),
(2, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-2.jpg', 1, '1703268849', '', 1),
(3, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-3.jpg', 2, '1703268849', '', 1),
(4, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-4.jpg', 2, '1703268849', '', 1),
(5, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-5.jpg', 1, '1703268849', '', 1),
(6, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-6.jpg', 1, '1703268849', '', 1),
(7, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-7.jpg', 1, '1703268849', '', 1),
(8, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-8.jpg', 1, '1703268849', '', 1),
(9, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-9.jpg', 2, '1703268849', '', 1),
(10, 'Cdc Issues Health Alert Notice For Travelers To Usa From Hon', 'Kerry Jones', 'Thinking about overseas adventure travel? Have you put any thought into the best places\r\n                                to go when it comes to overseas adventure travel? Nepal is one of the most popular\r\n                                places of all, when you visit this magical country you will have the best adventures\r\n                                right there at your doorstep. Only overseas adventure travel in Nepal will give you\r\n                                these kinds of opportunities so if this is not on your list of possible places to visit\r\n                                yet then now is the time to put it on there!', 'blog-10.jpg', 2, '20231208', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(2) NOT NULL,
  `date-in` varchar(255) NOT NULL,
  `date-out` varchar(255) NOT NULL,
  `nights` int(2) NOT NULL,
  `total` int(11) NOT NULL,
  `thanhToan` int(10) NOT NULL,
  `timeBooking` varchar(255) NOT NULL,
  `timeHuy` varchar(255) NOT NULL,
  `timeThanhToan` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `idUser`, `name`, `phone`, `email`, `address`, `idRoom`, `price`, `quantity`, `date-in`, `date-out`, `nights`, `total`, `thanhToan`, `timeBooking`, `timeHuy`, `timeThanhToan`, `status`) VALUES
(4, '10', 'Nga', '0123456789', '', 'Quảng Bình', 6, 120, 1, '15 December, 2023', '18 December, 2023', 3, 360, 0, '1702487405', '1702487405', '', 3),
(5, '10', 'Hà Thị Thúy Nga', '0388791600', '', 'Quảng Bình', 11, 120, 1, '01 January, 2024', '03 January, 2024', 2, 240, 240, '1704017462', '', '', 4),
(6, '10', 'Nga', '0123456789', '', 'Quảng Bình', 12, 120, 1, '15 December, 2023', '18 December, 2023', 3, 360, 0, '1702487405', '1702487405', '', 2),
(7, '10', 'Hà Thị Thúy Nga', '0388791600', '', 'Quảng Bình', 14, 120, 1, '01 January, 2024', '03 January, 2024', 2, 240, 240, '1704017462', '', '', 4),
(8, '10', 'Nga', '0123456789', '', 'Quảng Bình', 15, 120, 1, '15 December, 2023', '18 December, 2023', 3, 360, 0, '1702487405', '1702487405', '', 1),
(9, '10', 'Hà Thị Thúy Nga', '0388791600', '', 'Quảng Bình', 6, 120, 1, '01 January, 2024', '03 January, 2024', 2, 240, 0, '1704017462', '', '', 2),
(10, '10', 'Hà Thị Thúy Nga', '0388791600', '', 'Quảng Bình', 11, 120, 1, '01 January, 2024', '03 January, 2024', 2, 240, 0, '1704017462', '', '', 1),
(12, '10', 'Nga', '0388791600', 'nga@gmail.com', 'Quảng Bình', 12, 70, 1, '01 January, 2024', '03 January, 2024', 2, 140, 0, '1704043764', '', '', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_blog`
--

CREATE TABLE `category_blog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_blog`
--

INSERT INTO `category_blog` (`id`, `name`) VALUES
(1, 'Travelling'),
(2, 'Camping');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_room`
--

CREATE TABLE `category_room` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_room`
--

INSERT INTO `category_room` (`id`, `name`, `size`, `capacity`, `bed`, `price`, `image`) VALUES
(1, 'Standard Room', '20-25', '1-2', 'Single bed, Double bed', '20-60', 'room-b1.jpg'),
(3, 'Deluxe Room', '25-35', '2-3', 'Double bed, Queen bed', '40-120', 'room-b2.jpg'),
(4, 'Suite Room', '40-50', '2-5', 'Queen bed, King bed', '80-250', 'room-b3.jpg'),
(5, 'Family Room', '25-35', '3-4', 'Double bed, Queen bed', '50-150', 'room-b4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `social` varchar(255) NOT NULL,
  `map` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `address`, `phone`, `email`, `social`, `map`) VALUES
(1, 'Đà Nẵng', '0123456789', 'sona@gmail.com', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7332975516074!2d108.24978007464067!3d15.9752982419467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1704082484721!5m2!1svi!2s');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanhoi`
--

CREATE TABLE `phanhoi` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanhoi`
--

INSERT INTO `phanhoi` (`id`, `idUser`, `message`) VALUES
(1, 10, 'hãy thêm nhiều phòng hơn'),
(2, 10, 'hãy thêm nhiều phòng hơn'),
(3, 10, 'hãy thêm nhiều phòng hơn'),
(4, 10, 'hãy thêm nhiều phòng hơn'),
(5, 10, 'hãy thêm nhiều phòng hơn'),
(6, 10, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `star` int(1) NOT NULL,
  `content` text NOT NULL,
  `timePost` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `review`
--

INSERT INTO `review` (`id`, `idUser`, `idRoom`, `star`, `content`, `timePost`) VALUES
(18, 10, 6, 5, 'good', '1702021124'),
(22, 10, 6, 5, 'good', '1702021124'),
(23, 10, 6, 5, 'good', '1702021124'),
(24, 10, 6, 5, 'good', '1702021124'),
(25, 12, 12, 5, 'good', '1702021124'),
(26, 12, 12, 5, 'good', '1702021124'),
(27, 12, 12, 5, 'good', '1702021124'),
(36, 10, 6, 5, 'oke lắm', '1704035571');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberRoom` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(2) NOT NULL,
  `star` float NOT NULL,
  `size` int(2) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `adult` int(1) NOT NULL,
  `children` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `id_category` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `name`, `numberRoom`, `detail`, `image`, `price`, `quantity`, `star`, `size`, `bed`, `adult`, `children`, `status`, `id_category`) VALUES
(6, ' Deluxe Double with Balcony', '201', 'Phòng Deluxe Double with Balcony là phòng sang trọng với ban công riêng, cho phép khách thư giãn và ngắm cảnh thành phố hoặc quang cảnh xung quanh. Phòng được trang bị nội thất cao cấp, TV màn hình phẳng, minibar, phòng tắm tiện nghi.', 'DeluxeDoubleRoomwithBalconyandSeaView-1.jpg', 120, 3, 5, 25, 'Double Bed', 2, 0, 1, 3),
(11, 'Standard Single', '101', 'Phòng Standard Single là phòng tiện nghi và thoải mái dành cho du khách đi một mình. Phòng được trang bị đầy đủ tiện nghi cần thiết như TV, bàn làm việc, phòng tắm riêng. Nó là lựa chọn phổ biến cho những người đi công tác hoặc du lịch một mình.', 'standard-sigle-1.jpg', 56, 5, 5, 20, 'Single bed', 1, 0, 1, 1),
(12, 'Standard Double', '102', 'Phòng Standard Double là sự lựa chọn phổ biến cho cặp đôi hoặc du khách muốn chia phòng với bạn bè. Phòng được trang bị tiện nghi như TV màn hình phẳng, minibar, phòng tắm riêng. Nó cũng có thể có view nhìn ra thành phố hoặc view đẹp khác tùy thuộc vào vị trí của khách sạn.', 'standard-double-1.jpg', 70, 4, 0, 25, 'Double bed', 2, 0, 1, 1),
(14, 'Standard Family', '103', 'Phòng Standard Family rộng rãi và phù hợp cho gia đình nhỏ hoặc nhóm bạn. Phòng được trang bị đầy đủ tiện nghi, có không gian riêng để thư giãn và tiện ích như TV lớn, minibar và phòng tắm tiện nghi.', 'standard-family-capa-3-1.jpg', 99, 2, 0, 30, '1 Double bed, 1 Single bed', 2, 1, 1, 1),
(15, 'Standard Family', '104', 'Phòng Standard Family rộng rãi và phù hợp cho gia đình nhỏ hoặc nhóm bạn. Phòng được trang bị đầy đủ tiện nghi, có không gian riêng để thư giãn và tiện ích như TV lớn, minibar và phòng tắm tiện nghi.', 'standard-family-1.jpg', 105, 2, 0, 30, '2 Double bed', 2, 2, 1, 1),
(17, 'Deluxe Suite', '202', 'Phòng Deluxe Suite là sự kết hợp hoàn hảo giữa không gian sống và không gian ngủ. Nó bao gồm phòng khách riêng biệt và một hoặc hai phòng ngủ. Suite thường có view đẹp, nội thất sang trọng, tiện nghi cao cấp như minibar, TV màn hình phẳng và phòng tắm lớn.', 'deluxe-suite-1.png', 200, 3, 0, 35, '1 King bed, 1 Queen bed', 4, 0, 1, 3),
(18, 'Deluxe Family', '203', 'Phòng Deluxe Family là lựa chọn tuyệt vời cho các gia đình lớn hoặc nhóm bạn. Phòng rộng rãi với không gian sống riêng, các tiện nghi hiện đại và phòng tắm tiện nghi. Nó cung cấp không gian thoải mái để cả gia đình có thể tận hưởng kỳ nghỉ.', 'Family-Deluxe-1.jpg', 150, 2, 0, 35, '2 Queen bed', 4, 1, 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_tiennghi`
--

CREATE TABLE `room_tiennghi` (
  `id` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL,
  `idAmenities` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_tiennghi`
--

INSERT INTO `room_tiennghi` (`id`, `idRoom`, `idAmenities`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `detail`, `icon`, `status`) VALUES
(1, 'Travel Plan', 'Our hotel can provide destination information, flight reservations, tour bookings or support services related to regional travel.', 'flaticon-036-parking', 1),
(2, 'Catering Service', 'This is a service providing food and drinks for events and parties at the hotel. May include serving breakfast, lunch, dinner, or special parties such as conferences, weddings, birthday parties, etc.', 'flaticon-033-dinner', 1),
(3, 'Babysitting', 'This service provides babysitters to help you relax and enjoy your time without worrying about childcare.', 'flaticon-026-bed', 1),
(4, 'Laundry', 'Customers can wash their clothes and personal items conveniently and quickly.', 'flaticon-024-towel', 1),
(5, 'Hire Driver', 'We can provide a car and driver for you to travel within the city or locally, ensuring you have a convenient and safe vehicle.', 'flaticon-044-clock-1', 1),
(6, 'Bar & Drink', 'We provide drinks and beverages at the bar or in areas for guests to enjoy and relax.', 'flaticon-012-cocktail', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slided`
--

CREATE TABLE `slided` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slided`
--

INSERT INTO `slided` (`id`, `image`) VALUES
(1, 'hero-1.jpg'),
(2, 'hero-2.jpg'),
(4, 'hero-3.jpg'),
(6, 'hero-5.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `nameCustomer` varchar(255) NOT NULL,
  `addressCustomer` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `testimonial`
--

INSERT INTO `testimonial` (`id`, `nameCustomer`, `addressCustomer`, `content`, `img`, `star`) VALUES
(1, 'David L.', 'London', 'Great service! I had a really comfortable and well-appointed stay here. Friendly staff and clean room.', 'David.jpg', 5),
(2, 'Anna K.', 'New York', 'This hotel has a convenient location and very nice room view. I am really satisfied with the service and will come back if I have the opportunity.', 'Anna.png', 4),
(3, 'Emily T.', 'Sydney', 'This is a perfect choice for my family vacation. The childcare service is great, giving us time to relax.', 'Emily.png', 4),
(4, 'Michael R.', 'Tokyo', 'I held an event at this hotel and everything went smoothly. The banquet service and working space were both very good.', 'Michael.jpg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tiennghi`
--

CREATE TABLE `tiennghi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tiennghi`
--

INSERT INTO `tiennghi` (`id`, `name`, `status`) VALUES
(1, 'Wifi', 1),
(2, 'Tivi', 1),
(3, 'Air conditioning', 1),
(4, 'Fridge', 1),
(5, 'Nóng lạnh', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `timeRegister` varchar(255) NOT NULL,
  `lastUpdated` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `Fullname`, `Password`, `Email`, `Phone`, `Address`, `Birthday`, `timeRegister`, `lastUpdated`, `Avatar`, `status`) VALUES
(10, 'Hà Thị Thúy Nga', '12345', 'nga123@gmail.com', '0388761600', 'Quảng Bình', '2004-07-04', '1703268849', '', 'user-Nga.png', 1),
(12, 'Thúy Nga', '12345', 'nga@gmail.com', '0388791600', 'Quảng Bình', '2005-07-04', '1703268849', '1703920345', 'user.png', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_blog`
--
ALTER TABLE `category_blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_room`
--
ALTER TABLE `category_room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_fk_room` (`idRoom`),
  ADD KEY `review_fk_user` (`idUser`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_images_ibfk_1` (`room_id`);

--
-- Chỉ mục cho bảng `room_tiennghi`
--
ALTER TABLE `room_tiennghi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slided`
--
ALTER TABLE `slided`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tiennghi`
--
ALTER TABLE `tiennghi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `category_blog`
--
ALTER TABLE `category_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `category_room`
--
ALTER TABLE `category_room`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `room_tiennghi`
--
ALTER TABLE `room_tiennghi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `slided`
--
ALTER TABLE `slided`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tiennghi`
--
ALTER TABLE `tiennghi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_fk_room` FOREIGN KEY (`idRoom`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `review_fk_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
