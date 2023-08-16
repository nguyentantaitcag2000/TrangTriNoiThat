-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 16, 2023 lúc 07:32 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pthtw2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `ID_Bill` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `CreateDate` timestamp NULL DEFAULT current_timestamp(),
  `TotalMoney` int(11) DEFAULT NULL,
  `VAT_rate` int(11) DEFAULT 8,
  `VAT_amount` int(11) NOT NULL,
  `TotalMoneyCheckout` float NOT NULL,
  `Address_Bill` varchar(500) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ID_BS` int(11) DEFAULT 1,
  `ID_MOB` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`ID_Bill`, `ID_User`, `CreateDate`, `TotalMoney`, `VAT_rate`, `VAT_amount`, `TotalMoneyCheckout`, `Address_Bill`, `ID_BS`, `ID_MOB`) VALUES
(12, 2, '2023-03-30 10:28:25', 2304910, 8, 0, 2489300, '123', 4, NULL),
(13, 2, '2023-03-30 11:09:51', 11560482, 8, 0, 12485300, 'YUIYUI', 2, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `ID_Product` int(11) NOT NULL,
  `ID_Bill` int(11) NOT NULL,
  `Amount_BD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`ID_Product`, `ID_Bill`, `Amount_BD`) VALUES
(129, 12, 1),
(128, 12, 1),
(129, 13, 3),
(128, 13, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_status`
--

CREATE TABLE `bill_status` (
  `ID_BS` int(11) NOT NULL,
  `Name_BS` varchar(30) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_status`
--

INSERT INTO `bill_status` (`ID_BS`, `Name_BS`) VALUES
(1, 'Đang xử lý'),
(2, 'Đã thanh toán'),
(3, 'Đang vận chuyển'),
(4, 'Đã hủy đơn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `ID_Category` int(11) NOT NULL,
  `Name_Category` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Icon` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`ID_Category`, `Name_Category`, `Icon`) VALUES
(13, 'Bóng đèn', '/public/images/categories/category13.jpg'),
(14, 'Giường', '/public/images/categories/category14.jpg'),
(15, 'Đồng hồ', '/public/images/categories/category15.jpg'),
(16, 'Tủ', '/public/images/categories/category16.jpg'),
(17, 'Bàn', '/public/images/categories/category17.jpg'),
(18, 'Ghế', '/public/images/categories/category18.jpg'),
(19, 'Đệm', '/public/images/categories/category19.jpg'),
(20, 'Tranh', '/public/images/categories/category20.jpg'),
(21, 'Kệ', '/public/images/categories/category21.jpg'),
(22, 'Gấu bông', '/public/images/categories/category22.jpg'),
(23, 'Chăn ga', '/public/images/categories/category23.jpg'),
(24, 'Móc khoá', '/public/images/categories/category24.jpg'),
(25, 'Gương', '/public/images/categories/category25.jpg'),
(26, 'Bàn trang điểm', '/public/images/categories/category26.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

CREATE TABLE `color` (
  `ID_Color` int(11) NOT NULL,
  `Name_Color` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `color`
--

INSERT INTO `color` (`ID_Color`, `Name_Color`) VALUES
(0, 'Không xác định'),
(1, 'Đỏ thẫm'),
(2, 'Đỏ tươi'),
(3, 'Đỏ cam'),
(4, 'Đỏ đun'),
(5, 'Vàng chanh'),
(6, 'Vàng nhạt'),
(7, 'Vàng cam'),
(8, 'Xanh lá cây'),
(9, 'Xanh lam'),
(10, 'Xanh dương'),
(11, 'Xanh lục'),
(12, 'Trắng tinh'),
(13, 'Trắng sữa'),
(14, 'Kem'),
(15, 'Đen nhám'),
(16, 'Đen sâu'),
(17, 'Đen mờ'),
(18, 'Xám bạc'),
(19, 'Xám đen'),
(20, 'Xám nâu'),
(21, 'Nâu đậm'),
(22, 'Nâu nhạt'),
(23, 'Nâu cam'),
(24, 'Nâu đỏ'),
(25, 'Hồng nhạt'),
(26, 'Hồng phấn'),
(27, 'Hồng đậm'),
(28, 'Tím nhạt'),
(29, 'Tím đậm'),
(30, 'Tím cam'),
(31, 'Cam đất'),
(32, 'Cam đỏ'),
(33, 'Cam nhạt'),
(34, 'Cam san hô');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_product_color`
--

CREATE TABLE `detail_product_color` (
  `ID_Color` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `ID_DPC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `detail_product_color`
--

INSERT INTO `detail_product_color` (`ID_Color`, `ID_Product`, `ID_DPC`) VALUES
(0, 32, 13),
(0, 33, 14),
(0, 34, 15),
(0, 35, 16),
(0, 38, 17),
(0, 39, 18),
(0, 40, 19),
(0, 41, 20),
(0, 42, 21),
(0, 43, 22),
(0, 44, 23),
(0, 46, 24),
(0, 47, 25),
(0, 48, 26),
(0, 49, 27),
(0, 50, 28),
(0, 51, 29),
(0, 52, 30),
(0, 53, 31),
(0, 54, 32),
(0, 55, 33),
(0, 56, 34),
(0, 57, 35),
(0, 58, 36),
(0, 59, 37),
(0, 60, 38),
(0, 61, 39),
(0, 62, 40),
(0, 63, 41),
(0, 64, 42),
(0, 65, 43),
(0, 66, 44),
(0, 67, 45),
(0, 68, 46),
(0, 69, 47),
(0, 70, 48),
(0, 71, 49),
(0, 72, 50),
(0, 73, 51),
(0, 74, 52),
(0, 75, 53),
(0, 76, 54),
(0, 77, 55),
(0, 78, 56),
(0, 79, 57),
(0, 80, 58),
(0, 81, 59),
(0, 82, 60),
(0, 83, 61),
(0, 84, 62),
(0, 85, 63),
(0, 86, 64),
(0, 87, 65),
(0, 88, 66),
(0, 89, 67),
(0, 91, 68),
(0, 92, 69),
(0, 93, 70),
(0, 94, 71),
(0, 95, 72),
(0, 96, 73),
(0, 97, 74),
(0, 98, 75),
(0, 99, 76),
(0, 100, 77),
(0, 101, 78),
(0, 102, 79),
(0, 103, 80),
(0, 104, 81),
(0, 105, 82),
(0, 106, 83),
(0, 107, 84),
(0, 108, 85),
(0, 109, 86),
(0, 110, 87),
(0, 111, 88),
(0, 112, 89),
(0, 113, 90),
(0, 114, 91),
(0, 115, 92),
(0, 116, 93),
(0, 117, 94),
(0, 118, 95),
(0, 119, 96),
(0, 120, 97),
(0, 121, 98),
(0, 122, 99),
(0, 124, 101),
(7, 130, 133),
(7, 129, 134),
(7, 128, 135),
(6, 127, 136),
(21, 126, 137);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_product_image`
--

CREATE TABLE `detail_product_image` (
  `ID_DPI` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `Image` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `export_history`
--

CREATE TABLE `export_history` (
  `ID_EH` int(11) NOT NULL,
  `ID_Bill` int(11) NOT NULL,
  `Amount_EH` int(11) DEFAULT NULL,
  `Price_EH` int(11) DEFAULT NULL,
  `TotalMoney_EH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_history`
--

CREATE TABLE `import_history` (
  `ID_Bill` int(11) NOT NULL,
  `ID_IH` int(11) NOT NULL,
  `Amount_IH` int(11) DEFAULT NULL,
  `Price_IH` int(11) DEFAULT NULL,
  `TotalMoney_IH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `import_history`
--

INSERT INTO `import_history` (`ID_Bill`, `ID_IH`, `Amount_IH`, `Price_IH`, `TotalMoney_IH`) VALUES
(12, 1, 1, 1143472, 2489303),
(12, 2, 1, 1161438, 2489303),
(13, 3, 3, 1143472, 12485321),
(13, 4, 7, 1161438, 12485321);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `methodofpayment`
--

CREATE TABLE `methodofpayment` (
  `ID_MOB` int(11) NOT NULL,
  `Name_MOP` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `Name` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`Name`, `Status`, `Description`) VALUES
('password_strength', 0, ''),
('search_suggestion', 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ID_Product` int(11) NOT NULL,
  `ID_Category` int(11) NOT NULL,
  `Name_Product` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Avatar` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Size` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Material` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ID_Product`, `ID_Category`, `Name_Product`, `Description`, `Price`, `Avatar`, `Size`, `Material`) VALUES
(32, 20, 'Tranh cát chuyển động 3D hình tròn, tranh cát chảy', 'THÔNG TIN SẢN PHẨM:\nKích thước:\n- Tranh hình chữ Nhật :\n+ Size 5 inch: 17,5cm x 13,5cm\n+ Size 7 inch: 22cm x 17cm\n+ Size 10 inch: 25cm x 30cm\n- Tranh hình Tròn :\n+ Size 7 inch : 18cm x 19cm ( cả chân đế )\n+ Size 12 inch : 25cm x 26cm ( cả chân đế )\nCân nặng: 0.5kg\nChất liệu : thủy tinh, acrylic dày, dung dịch lỏng và cát\nPhù hợp với lứa tuổi : Tất cả\nĐộ bền cao, an toàn không độc hại\nMàu sắc đẹp, bắt mắt, phù hợp làm quà tặng, trang trí decor.\nBỘ SẢN PHẨM TRANH CÁT CHUYỂN ĐỘNG NÀY BAO GỒM:\n+ 01 tranh cát chuyển động.\n+ 01 giá đỡ, 01 hộp sang trọng\nTính năng:\n\nCát chuyển động mượt mà làm giảm căng thẳng, thư giãn mắt và tăng sự kiên nhẫn.\nMỗi lần lật có thể tạo ra một bức tranh động hoàn toàn không lặp đi lặp lại.\nNó có lợi cho sự cải thiện tâm trạng. Gọng kính trong suốt và sang trọng.\nKhung bên trong của nhựa có cảm giác lõm và lồi mạnh mẽ.\nThích hợp để trang trí bàn làm việc phòng khách và phòng ngủ.\nChất liệu acrylic tinh tế và dày\nCó thể đặt ở bất cứ đâu, chẳng hạn như khách sạn, nhà hàng, quán bar, vũ trường, phòng ngủ, văn phòng và phòng học.\nDòng Chảy kết hợp của chất lỏng cho phép mỗi vòng quay chảy trơn tru.\nCó thể đặt trên bàn như một khung ảnh.\n\nMÔ TẢ THUỘC TÍNH SẢN PHẨM:\n- Tên sản phẩm: Tranh cát chuyển động 3d nghệ thuật magic hình chữ nhật, tròn làm quà tặng phong thủy\n\n#tranhcát #tranhcat #tranhcát3d #tranhcat3d #tranhcátchuyểnđộng #tranhcátchuyểnđộng3d\n\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....', 100000, '/public/images/products/product32/product32_main.jpg', NULL, NULL),
(33, 22, 'Gấu bông mèo béo, gấu bông sang trọng, đồ chơi thú', 'Đặc điểm của gấu bông mèo béo cực đáng yêu:\n   - Sản phẩm được thiết kế vô cùng ngộ nghĩnh đáng yêu, màu sắc tươi sáng bắt mắt giúp kích thích trí tưởng tượng của trẻ và truyền cảm hứng cho sự sáng tạo\n   - Giúp giữ ấm và tạo cho bạn cảm giác mềm mại, thích thú\n   - Sử dụng trong việc trang trí phòng khách, phòng ngủ, không gian sống\n   - Nhân viên văn phòng có thể dùng làm gối tựa, gối ôm. Nhấn, ôm thú bông có thể giúp giải tỏa căng thẳng stress\n   - Không chỉ là người bạn cho trẻ, thú bông còn là Món quà gắn kết tình cảm tuyệt vời, Quà tặng sinh nhật bạn bè, đồng nghiệp, quà tặng giáng sinh, ngày lễ tình nhâ\n\nThông tin sản phẩm:\n   - Kích cỡ: có 3 loại kích thước: 30cm, 50cm, 70cm\n   - Màu sắc đa dạng với 4 màu : vàng, tro, trắng tro, trắng vàng\n   - Chất liệu cao cấp, An Toàn với trẻ nhỏ, không gây hại cho sức khỏe\n       + Vỏ ngoài được may bằng vải lông nhung ngắn, hình thêu sắc nét, đường may chắc chắn, độ nẩy rất tốt\n       + Sử dụng 100% bông gòn trắng độ đàn hồi tốt tạo cảm gi', 200000, '/public/images/products/product33/product33_main.jpg', NULL, NULL),
(34, 13, 'Đèn Led Trang Trí Bóng Tròn Dài 6M - 40  Bóng Tran', '- Đèn Led Trang Trí Dài 6M - 40 Bóng Trang Trí Noel Lễ Tết là sản phẩm không thể thiếu khi trang trí các quán cafe, nhà hàng , karaoke, lễ hội , các phòng studio chụp ảnh , gia đình các dịp lễ , tết , noel ,\n- Thiết kế nhiểu kiểu dáng để bạn lựa chọn phù hợp với các mục đích sử dụng khác nhau .\n- Sử Dụng được nhiều đầu cắm dòng phát điện khác nhau như : Dùng Cắm Điện Trực Tiếp nguồn điện 110-220v hoặc dùng Pin ( 3 viên Pin AAA ) .\n- Chất liệu bóng đèn nhựa ABS trắng đục cho ánh sáng lung linh ấm áp , kết hợp với dây nhựa dẻo chắc chắn chịu lực đến 5kg kho lỡ có vật nặng rơi trúng cũng ko dễ đứt. Ngoài ra còn có khả năng cách điện tốt , an toàn có thể dùng chụp ảnh quấn trên người người mẫu trong các phòng studio để bức hình thêm lung linh hơn .\n- Lưu ý : Không sử dụng bóng đèn trang trí dưới nước như hồ bơi , bể cá . Có thể trang trí bên ngoài hoặc trên thành hồ bơi.\n\n \n\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ', 80000, '/public/images/products/product34/product34_main.jpg', NULL, NULL),
(35, 15, 'Đồng Hồ Treo Tường Kim Trôi Cao Cấp HONO', 'Kích thước: đường kính 30cm, dày 4cm Màu sắc:  Viền đen mặt đen Viền đen mặt trắng Viền trắng mặt trắng Viền trắng mặt xám Chất liệu: Nhựa PP cao cấp\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....', 98000, '/public/images/products/product35/product35_main.jpg', NULL, NULL),
(38, 18, 'Ghế Lưng Lưới Cao Chân Xoay GX206', 'sản phẩm đem tới một giá trị vượt ngoài tầm mong đợi của khách hàng. Giá trị về SỨC KHỎE, TINH THẦN, MÔI TRƯỜNG, PHONG THÁI,….', 900000, '/public/images/products/product38/product38_main.jpg', NULL, NULL),
(39, 18, 'Ghế Văn Phòng Lưng Quạt Chân Xoay GHE_VP405', 'Chất lượng nằm ở phân khúc tầm trung, thiết kế kiểu dáng đẹp mắt, màu sắc sạch sẽ và giá thành hợp lý.Đệm ngồi thoáng mát – thiết kế vừa vặn', 90000, '/public/images/products/product39/product39_main.jpg', NULL, NULL),
(40, 18, 'Ghế Công Thái Học Cao Cấp TMS06 Trắng', 'Để đáp ứng nhu cầu nghỉ trưa, thư giãn của dân văn phòng, đầu năm 2022 này, Thiên Minh cho ra mắt mẫu ghế ngủ thông minh CÔNG THÁI HỌCTMS06 có tích hợp các tính năng như ngả lưng sâu, gác chân, tựa đầu,… mang lại những công dụng tuyệt vời dành cho sức khỏe của bạn.', 60000, '/public/images/products/product40/product40_main.jpg', NULL, NULL),
(41, 18, 'Ghế Văn Phòng Lưng Lưới Chân Quỳ GHE_VP4001', 'Một sản phẩm “quốc dân” nữa mà Nội thất Thiên Minh gửi đến quý vị đó là ghế chân quỳ GHE_VP4001.C2C.M1 siêu rẻ nhưng vẫn đáp ứng được những tính năng cần có của một chiếc ghế văn phòng. Về tổng thể, bất cứ ai khi ngồi mẫu Ghế Phòng Họp Chân Quỳ CQ – 4001 đều có cảm nhận chung đó là sự thoải mái vì vậy, từ khi được ra mắt sản phẩm đã trở thành sự lựa chọn hàng đầu cho những không gian phòng họp. Sản phẩm có bề mặt rộng rãi được thiết kế với cấu trúc chuẩn, đường cong sát cơ thể giúp bảo vệ cột sống và luôn thoải mái khi ngồi làm việc trong thời gian dài.', 500000, '/public/images/products/product41/product41_main.jpg', NULL, NULL),
(42, 18, 'Ghế Da Chân Quỳ Cho Giám Đốc GHE_VPCQ642', 'Ghế Da Chân Quỳ Cho Giám Đốc GHE_VPCQ642 là sản phẩm nổi bật và ấn tượng trong bộ sưu tập ghế chân quỳ tại Nội thất Thiên Minh bởi cách thiết kế sang trọng, tinh tế trên từng đường nét. Chính vì vậy, đây là mẫu ghế rất thích hợp để làm ghế phòng họp cao cấp hoặc ghế cho lãnh đạo.Ghế Da Chân Quỳ Cho Giám Đốc được thiết kế với kiểu dáng sang trọng, hiện đại phù hợp mọi không gian văn phòng.', 60000, '/public/images/products/product42/product42_main.jpg', NULL, NULL),
(43, 18, 'Ghế Lưng Lưới Cao Chân Quỳ CQ206', 'GHE_VP206 được thiết kế khá đơn giản, vững chắc với lót nhựa cố định không dễ dàng di chuyển khi đang làm việc giúp bạn tập trung cao hơn khi họp hành hay làm việc. Sản phẩm này rất phù hợp với các không gian phòng họp, phòng game, ghế cho nhân viên, hay sử dụng như ghế làm việc tại nhà.', 200000, '/public/images/products/product43/product43_main.jpg', NULL, NULL),
(44, 18, 'Ghế Giám Đốc Thư Giãn GHE_VPZC83', 'Tại văn phòng, bên cạnh thời gian dành cho công việc thì chúng ta cũng cần có thời gian để nghỉ ngơi hồi sức vào buổi trưa để có sức khỏe và tinh thần tiếp tục làm việc vào buổi chiều. Giấc ngủ ngắn buổi trưa rất quan trọng đối với sức khỏe bởi vậy bạn cần phải tạo được thói quen tốt đẹp này.Tuy nhiên, không phải nhân viên văn phòng nào cũng có điều kiện về nhà để nghỉ trưa bởi thời gian nghỉ trưa không dài, mà nhiều người phải di chuyển rất xa để đến chỗ làm, do vậy họ sẽ nghỉ ngơi ngay tại văn phòng. Trên thực tế có nhiều người thường ngồi ngay tại chỗ và ngủ bằng tư thế gục mặt xuống bàn hay nằm ngửa cổ ra sau. Tuy nhiên, ít ai biết đến đây chính là nguyên nhân gây ra nhiều căn bệnh văn phòng như đau lưng, đau vai, đau mỏi cổ.', 650000, '/public/images/products/product44/product44_main.jpg', NULL, NULL),
(46, 18, 'Ghế Gaming TS ngả lưng có gác chân màu trắng đen M', 'Ghế Gaming TS ngả lưng có gác chân màu trắng đen MA010T với màu sắc cực đẹp kết hợp giữa đen và Trắng tạo cảm giác mạnh mẽ cho chiếc ghế, bên cạnh đó là thiết kế tiêu chuẩn của ghế chơi game theo công thái học giúp tạo sự thoải mái nhất cho người ngồi lâu trên máy tính như các Game thủ hay các Streamer, Thiết kế cực kỳ thoải mái cho người ngồi với gối đầu và gối lưng. Bên cạnh đó ghế còn trang bị thêm gác chân và tính năng ngả nằm nhiều vị trí giúp bạn tận hưởng thời gian nghỉ ngơi một cách thoải mái nhất', 287228, '/public/images/products/product46/product46_main.jpg', NULL, NULL),
(47, 18, 'Ghế Gaming DXRacer ', 'Nó mang trong mình mọi tinh túy của hãng như thiết kế đẳng cấp, trải nghiệm ngồi thoải mái, chất liệu đắt tiền. Cụ thể hơn về ngoại hình của ghế. Nó không thực sự quá cầu kỳ nhưng với sự phối hợp đầy hài hòa giữa 2 mảng có thể nhận xét rằng nó hướng đến những gamer trung tính, không quá hardcore nhưng vẫn thích một sự ngầu nhất định.Không chỉ thiết kế, trải nghiệm của sản phẩm cũng được phản hồi lại rất tích cực. Điều này đến nhờ vào chất liệu cao cấp trong miếng đệm. Những phụ kiện đi kèm như gối cổ, đệm lưng hay hai miếng đệm bên tay cũng giúp game thủ thoải mái nhất. Tuy nhiên, việc chỉ có độ ngả 135 độ và thiếu đi miếng kê chân cũng làm yếu tố này của sản phẩm bị giảm đi phần nào trong mắt gamer.', 449212, '/public/images/products/product47/product47_main.jpg', NULL, NULL),
(48, 18, 'Ghế xoay nhân viên SG550', 'Với chất liệu nhựa ABS đồng hồ để bàn Thuận buồm xuôi gió sẽ giúp bạn kiểm soát thời gian một cách hợp lý và tăng tính thẩm mỹ cho khuôn viên làm việc hoặc văn phòng', 161759, '/public/images/products/product48/product48_main.jpg', NULL, NULL),
(49, 13, 'BÓNG ĐÈN LED BULB SUNHOUSE SPEC SHE-BULB-20W-S', 'Đèn LED BULB là thiết bị chiếu sáng không thể thiếu trong mọi không gian, từ văn phòng đến nhà riêng, nhà hàng hay khách sạn… Đây là giải pháp chiếu sáng thay thế hiệu quả cho hệ thống chiếu sáng cũ như đèn pha LED, bóng compact, bóng halogen...Với mong muốn đem đến giải pháp sống toàn diện cho người Việt, Tập đoàn SUNHOUSE cung cấp sản phẩm Bóng đèn LED Bulb SUNHOUSE Spec SHE-BULB-20W-S đui xoáy, ánh sáng trắng với những ưu điểm vượt trội: hiệu suất sáng cao, tuổi thọ lên đến 25.000 giờ chiếu sáng, tiết kiệm điện năng hay an toàn khi sử dụng…', 484280, '/public/images/products/product49/product49_main.jpg', NULL, NULL),
(50, 13, 'Đèn huỳnh quang đui xoắn E27', 'Bóng đèn led bulb có đui E27 hiện nay cũng có nhiều hình dạng khác nhau, phổ biến vẫn là các loại đèn led búp tròn hoặc chữ A.', 495917, '/public/images/products/product50/product50_main.jpg', NULL, NULL),
(51, 13, 'Đèn led bulb đui E12', ' thường được sử dụng cho các ứng dụng chiếu sáng trang trí, chẳng hạn như đèn chùm, đèn treo tường, đèn ngủ. Và các loại đèn có đui E12 – đường kính 12mm thường được mô phỏng theo hình ngọn nến hoặc quả nhót.', 590782, '/public/images/products/product51/product51_main.jpg', NULL, NULL),
(52, 13, 'Bóng đèn bulb có đui E14', 'thường được sử dụng phổ biến tại thị trường Châu  u và Trung Quốc. Chúng được sử dụng để lắp cho các loại đèn trang trí như đèn chùm hoặc đèn tường.', 598950, '/public/images/products/product52/product52_main.jpg', NULL, NULL),
(53, 13, 'Bóng đèn cảm biến Rada ánh sáng Rạng Đông ', '15w có tuổi thọ cao, tiết kiệm điện năng, ánh sáng không gây hại mắt, thân thiện môi trười. Đèn chỉ tự động bật sáng khi ánh sáng xung quanh vị trí lắp đèn ≤ 80 Lux và phát hiện có chuyển động trong vùng hoạt động của cảm biến, sau 60 giây nếu không phát hiện chuyển động đèn tự động tắt. Lắp đặt ở vị trí hành lang, cửa ra vào, nhà vệ sinh, gara…', 495150, '/public/images/products/product53/product53_main.jpg', NULL, NULL),
(54, 13, 'Đèn LED cảm biến cho tủ quần áo dùng pin sạc thân ', 'Đèn Led phát hiện khi nào có người chuyển động vào vùng quét của cảm biến PIR và tự động bật/tắt. Trong điều kiện môi trường ban ngày có đủ ánh sáng, đèn sẽ không bật kể cả khi có người vào để tiết kiệm điện. Với thiết kế sang trọng, đèn led rất phù hợp để sử dụng làm đèn trang  trí hoặc đèn treo tường ở mọi không gian trong nhà như: phòng khách, phòng ngủ, phòng tắm, tủ quần áo, tủ bếp…', 850324, '/public/images/products/product54/product54_main.jpg', NULL, NULL),
(55, 13, 'Bóng đèn Led cảm biến chuyển động Radar vi sóng Al', 'Trang bị cảm biến radar và cảm biến quang giúp bóng đèn Led Allmay có thể bật đèn chỉ khi trời tối và có chuyển động. Khi không có chuyển động, bóng đèn sẽ tự động tắt sau 18-25s, đặc biệt là sẽ không bật đèn khi trời sáng để tiết kiệm điện tối đa.', 533599, '/public/images/products/product55/product55_main.jpg', NULL, NULL),
(56, 13, 'Đèn LED cảm biến thân nhiệt DL-003/004', ' kích thước nhỏ gọn, siêu sáng tự động sáng khi có người và tắt khi không có người. Đèn cũng chỉ bật khi trời tối và có chuyển động, tự động tắt khi trời sáng nhằm tiết kiệm điện. Có 2 lựa chọn tiện dụng cho bạn: loại chân cắm và loại chân xoáy', 366246, '/public/images/products/product56/product56_main.jpg', NULL, NULL),
(57, 13, 'Đèn Led năng lượng mặt trời cảm biến cơ thể và ánh', ' tính năng thông minh sử dụng cảm biến chuyển động cơ thể người để bật đèn và còn trang bị thêm cảm biến ánh sáng, giúp đèn sẽ không bật đèn vào ban ngày (dù có phát hiện chuyển động hay không). Đèn led JP36 sử dụng 36 bóng đèn led siêu sáng giúp bạn chiếu sáng 1 vùng khá rộng và sử dụng năng lượng mặt trời nạp pin sạc chất lượng cao giúp bạn tiết kiệm năng lượng. Tính năng chống thấm nước giúp đèn sử dụng ngoài trời ở các vị trí ban công, hành lang, sân vườn, cửa chính nhà, bể bơi…', 232251, '/public/images/products/product57/product57_main.jpg', NULL, NULL),
(58, 13, 'Đèn Led cảm ứng chuyển động, ánh sáng LS-8905', ' thiết kế gần giống với hình đôi mắt của con người mang đến sự khác biệt và nổi bật so với các loại đèn LED thông thường. Đèn sẽ tự động bật khi phát hiện người chuyển động và môi trường xung quanh tối và tự động tắt nếu không có chuyển động hoặc trời sáng. Bạn có thể sử dụng sản phẩm ở nhiều vị trí: Hành lang, nhà vệ sinh, đèn ngủ, đèn tủ quần áo v.v… hoặc những chỗ thiếu ánh sáng và cần bật tắt tự động mà bạn không cần chạm tay vào công tắc.', 471144, '/public/images/products/product58/product58_main.jpg', NULL, NULL),
(59, 14, 'Giường ngủ Da Bò Ý ZDG172', 'Với chiếc giường nằm phòng ngủ sẽ có đầy đủ tiện nghi cần thiết cho việc nghỉ ngơi bao gồm cả thư giãn và cho giấc ngủ.Tiếp theo chiếc giường ngủ sẽ mang đến những giá trị cho căn phòng ngủ về mặt thẩm mỹ.Chiếc giường ngủ kết hợp với lớp vải lót thường là màu trắng giúp tạo nên điểm nhấn cho phòng ngủ.Nó còn còn tâm điểm quan trọng trong mọi cách thức bố trí nội thất cho phòng ngủ.', 797056, '/public/images/products/product59/product59_main.jpg', NULL, NULL),
(60, 14, 'Giường ngủ Da Bò Ý ZDG169', 'Với chiếc giường nằm phòng ngủ sẽ có đầy đủ tiện nghi cần thiết cho việc nghỉ ngơi bao gồm cả thư giãn và cho giấc ngủ.Nó còn còn tâm điểm quan trọng trong mọi cách thức bố trí nội thất cho phòng ngủ.Kết hợp tốt với những món đồ nội thất khác trong phòng để tạo nên không gian phòng ngủ thoải mái và cũng vững chắc nhất.', 358404, '/public/images/products/product60/product60_main.jpg', NULL, NULL),
(61, 14, 'Giường ngủ Khung Gỗ Sồi Nga GN-050', 'Với chiếc giường nằm phòng ngủ sẽ có đầy đủ tiện nghi cần thiết cho việc nghỉ ngơi bao gồm cả thư giãn và cho giấc ngủ.Tiếp theo chiếc giường ngủ sẽ mang đến những giá trị cho căn phòng ngủ về mặt thẩm mỹ.Chiếc giường ngủ kết hợp với lớp vải lót thường là màu trắng giúp tạo nên điểm nhấn cho phòng ngủ.Nó còn còn tâm điểm quan trọng trong mọi cách thức bố trí nội thất cho phòng ngủ.Kết hợp tốt với những món đồ nội thất khác trong phòng để tạo nên không gian phòng ngủ thoải mái và cũng vững chắc nhất.', 621910, '/public/images/products/product61/product61_main.jpg', NULL, NULL),
(62, 14, 'Giường ngủ gỗ gõ đỏ Campuchia dát phản liền tấm 1m', 'đẹp trong từng chi tiết. Đây chắc chắn sẽ là sản phẩm mang đến cho gia chủ những giấc ngủ ngon lành mỗi đêm sau một ngày dài mệt mỏi. Tổng thể chiếc giường ngủ gỗ gõ đỏ Campuchia có được sự chắc chắn, sang trọng. Chất liệu gỗ gõ đỏ quý hiếm tạo nên màu sắc bắt mắt, những đường vẫn gỗ tự nhiên. Các chi tiết chạm khắc tại đầu và đuôi giường không quá cầu kỳ nhưng cũng đủ để tạo thành điểm nhấn.', 483196, '/public/images/products/product62/product62_main.jpg', NULL, NULL),
(63, 14, 'Giường ngủ kiểu bo gỗ gõ đỏ.', 'Giường ngủ kiểu bo gỗ gõ đỏ.với đa dạng kích thước cho không gian phòng ngủ của bạn nó sẽ làm cho không gian phòng ngủ thêm sang trọng và tiện nghi hơn.Bạn có thể thoải mái ngả lưng trên chiếc giường sang trọng mang lại cho bạn giấc ngủ sâu và thoải mái hơn.', 501890, '/public/images/products/product63/product63_main.jpg', NULL, NULL),
(64, 14, 'Sofa giường gỗ ZD1205 gỗ sồi, sofa thông minh đa n', 'Là một chiếc sofa đa năng, một sản phẩm thông minh nhưng thực chất cũng được cấu tạo một chiếc sofa bình thường.Vì sự tích hợp của nhiều công dụng và sự thiết kế độc đáo đẹp mắt mà người tiêu dùng rất thích chọn loại sofa đa năng này.Kích thước của ghế sofaVới kích thước 200 x 60 x 60(cm) rất thoải mái cho người tiêu dùng sử dụng để ngồi uống nước, tiếp khách và có thể sử dụng làm giường ngủ khi cần thiết.Kích thước nhỏ gọn, không quá to cho nên bạn có thể để chiếc sofa này trong phòng khách, hay phòng ngủ.Sản phẩm sofa đa năng không quá nặng có trọng lượng 100kg.', 438770, '/public/images/products/product64/product64_main.jpg', NULL, NULL),
(65, 14, 'Giường ngủ Massage GN-168', 'Với chiếc giường nằm phòng ngủ sẽ có đầy đủ tiện nghi cần thiết cho việc nghỉ ngơi bao gồm cả thư giãn và cho giấc ngủ.Tiếp theo chiếc giường ngủ sẽ mang đến những giá trị cho căn phòng ngủ về mặt thẩm mỹ.Chiếc giường ngủ kết hợp với lớp vải lót thường là màu trắng giúp tạo nên điểm nhấn cho phòng ngủ.Nó còn còn tâm điểm quan trọng trong mọi cách thức bố trí nội thất cho phòng ngủ.Kết hợp tốt với những món đồ nội thất khác trong phòng để tạo nên không gian phòng ngủ thoải mái và cũng vững chắc nhất.', 448328, '/public/images/products/product65/product65_main.jpg', NULL, NULL),
(66, 14, 'Giường Hộc Kéo 601T', 'tiện lợi cho việc cất trữ quần áo, chăn gối, vật dụng…đang được nhiều gia đình lựa chọn. Ngoài chức năng tạo ra giấc ngủ ngon thì giường còn có chức năng phụ với những ngăn tủ nhỏ đựng đồ dùng độc đáo. Một phần giúp tiết kiệm không gian cho phòng ngủ thêm rộng rãi, thoải mái và thoáng mát. Thông thường, ngăn kéo được thiết kế ở hai bên vai giường hoặc ở cuối đuôi giường nhưng không làm mất đi sự liền lạc của giường mà còn tô điểm thêm cho chiếc giường thêm độc đáo, hấp dẫn, đảm bảo tính thẩm mỹ cao.', 968878, '/public/images/products/product66/product66_main.jpg', NULL, NULL),
(67, 14, 'Giường Ngủ Có Ngăn Kéo Giá Rẻ 604T', ' tiện lợi cho việc cất trữ quần áo, chăn gối, vật dụng…đang được nhiều gia đình lựa chọn. Ngoài chức năng tạo ra giấc ngủ ngon thì giường còn có chức năng phụ với những ngăn tủ nhỏ đựng đồ dùng độc đáo. Một phần giúp tiết kiệm không gian cho phòng ngủ thêm rộng rãi, thoải mái và thoáng mát. Thông thường, ngăn kéo được thiết kế ở hai bên vai giường hoặc ở cuối đuôi giường nhưng không làm mất đi sự liền lạc của giường mà còn tô điểm thêm cho chiếc giường thêm độc đáo, hấp dẫn, đảm bảo tính thẩm mỹ cao.', 774582, '/public/images/products/product67/product67_main.jpg', NULL, NULL),
(68, 14, 'GIƯỜNG THÔNG MINH ', 'Thậm chí là chăm sóc sức khỏe người dùng. Giúp cuộc sống trở nên tiện nghi dễ dàng hơn. Bao gồm cả các mẫu giường ngủ thông minh cho phòng nhỏ, giường ngủ ngăn kéo thông minh, giường kéo thông minh thành ghế sofa,…vv,Các mẫu giường thông minh được cải tiến và tích hợp nhiều công năng tiện ích. Cấu tạo và phương thức vận hành cũng đa dạng hơn. Từ giường kéo thông minh đến giường ngủ dạng gấp. Giới thiệu đến quý khách hàng những mẫu giường ngủ thông minh hot nhất hiện nay', 563433, '/public/images/products/product68/product68_main.jpg', NULL, NULL),
(69, 15, 'Đồng hồ treo tường KASHI', 'Đồng hồ treo tường KASHI mã HM960 với thiết kế hình tròn, vỏ gỗ tự nhiên, kiểu dáng đơn giản sang trọng, kích thước lớn phù hợp với không gian nội thất lớn hội trường, phòng họp, phòng khách rộng.', 557037, '/public/images/products/product69/product69_main.jpg', NULL, NULL),
(70, 15, 'Đồng hồ treo tường HM849 W', 'Đồng hồ treo tường kích thước lớn KASHI mã HM849 với thiết kế hình chữ nhật, máy điện tử siêu tĩnh, vành nhựa sơn vân gỗ chất lượng cao phù hợp với không gian hội trường, phòng họp, phòng khách rộng..... 12 số dạ quang tiện lợi cho việc xem giờ trong không gian không có ánh sáng (nhưng chỉ trong thời gian ngắn để đảm bảo cho sức khỏe chúng tôi dùng phát quang)', 355476, '/public/images/products/product70/product70_main.jpg', NULL, NULL),
(71, 15, 'Đồng hồ treo tường quả lắc New HM830 số học', 'Đồng hồ treo tường quả lắc có nhạc 830 thực sự là một trong những đột phá mới của các dòng đồng hồ quả lắc mang lại cho căn nhà của bạn phong cách phương Tây cổ điển nhưng không kém phần sang trọng và hiện đại. Nếu như trên thị trường đồng hồ với hình dáng tương tự nhưng bằng gỗ MDF với kích thước nhỏ và có giá lên tới gần 10 triệu đồng thì HM830 bằng gỗ tần bì tự nhiên sẽ giải quyết cho bạn mọi điểm hạn chế đó', 871671, '/public/images/products/product71/product71_main.jpg', NULL, NULL),
(72, 15, 'Đồng hồ treo tường quả lắc New HM888 số Học ', 'Đồng hồ treo tường quả lắc có nhạc 888 thực sự là một trong những đột phá mới của các dòng đồng hồ quả lắc mang lại cho căn nhà của bạn phong cách phương Tây cổ điển nhưng không kém phần sang trọng và hiện đại. Nếu như trên thị trường đồng hồ với hình dáng tương tự nhưng bằng gỗ MDF với kích thước nhỏ và có giá lên tới gần 10 triệu đồng thì HM888 bằng gỗ tần bì tự nhiên sẽ giải quyết cho bạn mọi điểm hạn chế đó', 876077, '/public/images/products/product72/product72_main.jpg', NULL, NULL),
(73, 15, 'ĐỒNG HỒ TREO TƯỜNG DECOR PHI HÀNH GIA DH155', 'thích hợp decor trang trí nhà cửa,Chất liệu: Thép + Nhựa ABS,DH155-A1: Rộng 50 x Cao 48 cm,DH155-A2: Rộng 60 x Cao 58 cm,Bảo hành: 1 năm ', 979376, '/public/images/products/product73/product73_main.jpg', NULL, NULL),
(74, 15, 'ĐỒNG HỒ TREO TƯỜNG CAO CẤP HƯƠU ĐỒNG MẠ VÀNG DH003', 'thích hợp decor trang trí nhà cửa làm cho nhà của bạn trở nên sang trọng và thời thượng', 553901, '/public/images/products/product74/product74_main.jpg', NULL, NULL),
(75, 15, 'ĐỒNG HỒ ĐỂ BÀN CAO CẤP HƯƠU TÀI LỘC MẠ VÀNG DHB013', 'thích hợp decor trang trí nhà cửa với chất liệu hợp kim mạ VPD đế đá giúp cho căn phòng của bạn trở nên sang trọng và thời thượng hơn', 245290, '/public/images/products/product75/product75_main.jpg', NULL, NULL),
(76, 15, 'ĐỒNG HỒ ĐỂ BÀN “THUẬN BUỒM XUÔI GIÓ” KS018', 'Với chất liệu nhựa ABS đồng hồ để bàn Thuận buồm xuôi gió sẽ giúp bạn kiểm soát thời gian một cách hợp lý và tăng tính thẩm mỹ cho khuôn viên làm việc hoặc văn phòng', 549550, '/public/images/products/product76/product76_main.jpg', NULL, NULL),
(77, 15, 'Đồng hồ treo tường trang trí DHV02', 'Làm đồng hồ treo tường trang trí phòng khách, phòng ngủ, sảnh khách sạn, nhà hàng, lễ tân, showroom, văn phòng. Ngoài việc dùng để xem giờ, có thể làm phụ kiện trang trí nội thất', 661275, '/public/images/products/product77/product77_main.jpg', NULL, NULL),
(78, 15, 'Đồng hồ treo tường trang trí DHV03', ' Làm đồng hồ treo tường trang trí phòng khách, phòng ngủ, sảnh khách sạn, nhà hàng, lễ tân, showroom, văn phòng. Ngoài việc dùng để xem giờ, có thể làm phụ kiện trang trí nội thất', 955959, '/public/images/products/product78/product78_main.jpg', NULL, NULL),
(79, 15, 'Đồng hồ treo tường trang trí DHV05', 'Làm đồng hồ treo tường trang trí phòng khách, phòng ngủ, sảnh khách sạn, nhà hàng, lễ tân, showroom, văn phòng. Ngoài việc dùng để xem giờ, có thể làm phụ kiện trang trí nội thất', 524054, '/public/images/products/product79/product79_main.jpg', NULL, NULL),
(80, 16, 'Tủ Quần Áo Gỗ MOHO VIENNA 201 4 Cánh 4 Màu', 'VIENNA là niềm ao ước đặt chân đến của nhiều người bởi nó là thủ đô nổi tiếng bậc nhất về sự lộng lẫy của các tòa lâu đài nguy nga, tráng lệ. Đây là nguồn cảm hứng cho bộ sưu tập nội thất VIENNA, nhờ vậy mà các sản phẩm thuộc bộ sưu tập này đều mang nét hiện đại của thủ đô nước Áo.Với màu sắc và lối thiết kế đơn giản dễ kết hợp các mẫu nội thất khác nhưng lại mang đến không gian hiện đại và sang trọng.Là chiếc tủ kết hợp gữa ngăn kệ, thanh treo, ngăn kéo giúp bạn có thế để lưu trữ một cách linh hoạt, gọn gàng và có thể lưu trữ được một lượng đồ lớn.', 547535, '/public/images/products/product80/product80_main.jpg', NULL, NULL),
(81, 16, 'Tủ quần áo gỗ công nghiệp', 'Tủ quần áo gỗ công nghiệp là tủ đựng quần áo được làm từ các loại gỗ công ngiệp như: gỗ MDF, HDF, MFC, gỗ ghép thanh,…được phủ bằng sơn, melamine, laminate…màu sắc rất phong phú và đa dạng.', 652751, '/public/images/products/product81/product81_main.jpg', NULL, NULL),
(82, 16, ' tủ nhựa Duy Tân', 'một kiểu thiết kế rất riêng và đặc trưng của hãng tủ này. Được thiết kế bao gồm nhiều ngăn, họa tiết trang trí ngộ nghĩnh chính là điểm nhấn ấn tượng của chiếc tủ nhựa Tabi Duy Tân. Ngăn kéo được thiết kế tay cầm chắc chắn bằng sắt đảm bảo độ bền, ít bong tróc so với tay cầm bằng nhựa.', 127463, '/public/images/products/product82/product82_main.jpg', NULL, NULL),
(83, 16, 'Tủ bếp gỗ xoan đào Hoàng Anh', 'ỗ xoan đào làm tủ bếp là loại chất liệu gỗ cứng, chắc chắn và có độ bền cao nên được rất nhiều gia chủ yêu thích. Màu sắc cánh gián ấm cúng của nguyên liệu gỗ này rẩ dễ phối hợp với những đồ nội thất khác trong căn phòng để tạo nên sự hài hòa. Bộ tủ bếp gỗ xoan đào mang vẻ đẹp mộc mạc với độ bền cao, rất thích hợp bố trí trong những gian bếp truyền thống hiện nay. ', 501895, '/public/images/products/product83/product83_main.jpg', NULL, NULL),
(84, 16, 'Tủ bếp gỗ tự nhiên', 'Loại tủ bếp này được chế tác với các mẫu mã đẹp, đa dạng, có sự bền đẹp với thời gian nhất là sản phẩm tủ bếp từ các loại gỗ cao cấp như gỗ sồi, gỗ đinh hương, gỗ lim... ngay cả khi tiếp xúc với nước hay di chuyển chỗ mà không lo bị hư hỏng', 767679, '/public/images/products/product84/product84_main.jpg', NULL, NULL),
(85, 16, 'Tủ bếp gỗ công nghiệp APF', ' Với nguồn nguyên liệu có sẵn và dễ dàng thiết kế, lắp đặt nên tủ bếp gỗ công nghiệp được sản xuất nhanh với mẫu mã phong phú và có giá thành vừa phải hợp túi tiền các gia đình.', 903290, '/public/images/products/product85/product85_main.jpg', NULL, NULL),
(86, 16, 'TỦ QUẦN ÁO MDF', ' đẹp là một trong những nội thất phòng ngủ không thể thiếu,. Việc thiết kế một tủ quần áo tiện dụng, phù hợp với không gian trong mỗi phòng ngủ là một điều thiết yếu, nhất là với những gia đình có diện tích căn hộ không lớn. ', 505286, '/public/images/products/product86/product86_main.jpg', NULL, NULL),
(87, 16, 'Tủ đầu giường ', 'Hiện nay sản phẩm TỦ ĐẦU GIƯỜNG THÔNG MINH luôn được đưa vào nội thất đi kèm không thể thiếu trong bộ nội thất phòng ngủ. Với mẫu mã kiểu dáng đa dạng và không ngừng đổi mới phù hợp với mọi phong cách nội thất TỦ ĐẦU GIƯỜNG GỖ khiến cho tổ ấm của bạn trở nên sang trọng và ấm áp.', 111525, '/public/images/products/product87/product87_main.jpg', NULL, NULL),
(88, 16, 'Tủ Giày Gỗ ', 'ử dụng để cất giày dép tại căn hộ, tại văn phòng, tại quán cafe, tại shop spa salon vô cùng thích hợp. Có ngăn thoáng để giày dép sử dụng thường xuyên. Nóc tủ có đợt tích hợp bày đồ trang trí. có tính thẩm mỹ cao, nên thường được sử dụng trong các khu vực công cộng dịch vụ cao cấp và sang trọng', 306178, '/public/images/products/product88/product88_main.jpg', NULL, NULL),
(89, 16, 'Tủ Mây', 'Đồ dùng đồ chơi của bé ba mẹ trang bị cho con vật dụng để đồ chơi và đặt chúng vào đúng nơi quy định và sau mỗi lần trẻ sử dụng đồ chơi không quên nhắc nhở con hãy nhặt và cất những đồ dùng đồ chơi vào giỏ ngay sau khi chơi xong. ', 612702, '/public/images/products/product89/product89_main.jpg', NULL, NULL),
(91, 22, 'Gấu Bông Thú Nhồi Bông Mèo Hoàng Thượng Quạo Quọ M', 'Gấu Bông Thú Nhồi Bông Mèo Hoàng Thượng Quạo Quọ Mập Ú Mặc Áo Hóa Trang Siêu Đáng Yêu. Màu sắc: Đen trắng. Kích thước: 25cm, 45cm. Đặc điểm nổi bật:.  + Bao phía bên ngoài là lớp vải bông mềm mại, tạo cảm giác êm ái khi ôm.  + Độ đàn hồi tốt, không bị xẹp.  + Bên trong Thú bông được', 1407737, '/public/images/products/product91/product91_main.jpg', NULL, NULL),
(92, 22, 'Gấu bông tốt nghiệp 25cm TNB214 tại E3 Audio Miền ', 'Gấu bông tốt nghiệp TNB214 là món quà tặng tốt nghiệp đặc biệt dành cho những ai sắp tốt nghiệp Tiến Sĩ, Thạc Sĩ, Đại Học, Cao Đẳng, Trung Cấ- Dành tặng cho học sinh, người thân của mình một chú Gấu cử nhân trong dịp lễ tốt nghiệp còn là dành tặng cho họ một thứ để khơi nguồn', 1736247, '/public/images/products/product92/product92_main.jpg', NULL, NULL),
(93, 22, 'Gấu Bông Heo Mắt Tròn Niềm Vui Ngơ Ngác Love u - M', 'Gấu Bông Heo Mắt Tròn Niềm Vui Ngơ Ngác Love u - Màu Hồng 40cm. Thiết kế xinh xắn với hình ảnh chú voi xanh đáng yêu, ngộ nghĩnh. Bên trong thú được nhồi lớp bông gòn nhân tạo có độ phồng và đàn hồi cao, khi ôm tạo cảm giác thoải mái, dễ chịu. Sản phẩm không chỉ là', 1224170, '/public/images/products/product93/product93_main.jpg', NULL, NULL),
(94, 22, 'Gấu Bông Gối Ôm Mèo Alaska Mắt Tròn Cao Cấp Memon ', 'Mèo Alaska mắt tròn nhồi bông đang là sản phẩm được nhiều bạn trẻ săn tìm. Mèo mắt tròn có hình dáng dễ thương, thiết kế năm thích hợp để ôm, để gối đầu. Mèo alaska nhồi bông là dòng sản phẩm cao cấp, vỏ nhung mềm mịn co dãn 4 chiều, bông nhồi bên trong 100% là bông gòn', 824794, '/public/images/products/product94/product94_main.jpg', NULL, NULL),
(95, 22, 'Gấu bông chó Shiba cosplay 25cm cao cấp - Hàng chí', 'Gấu bông chó Shiba cosplay nhồi bông đang là sản phẩm được nhiều bạn trẻ săn tìm. Chó bông Shiba có hình dáng cosplay mặc trang phục siêu dễ thương, cute, đáng yêu. Shiba cosplay là dòng sản phẩm cao cấp, vỏ nhung mềm mịn co dãn 4 chiều, bông nhồi bên trong 100% là bông gòn 3D trắng tinh', 594645, '/public/images/products/product95/product95_main.jpg', NULL, NULL),
(96, 22, 'Gấu Bông Gối Ôm Thú Bông, Nhồi Bông Hình Ly Trà Sữ', 'Gấu Bông Gối Ôm Thú Bông, Nhồi Bông Hình Ly Trà Sữa Xinh Xắn Ngộ Nghĩnh Siêu Hot. Lớp lông bên ngoài được sử dụng nhung cao cấp, lớp nhung mềm mại và êm ái. Với chất liệu vải cao cấp mềm mịn, 100% gòn trắng đàn hồi, tuyệt đối an toàn, có thiết kế hình bé heo nằm ngủ', 542206, '/public/images/products/product96/product96_main.jpg', NULL, NULL),
(97, 22, 'Cây Xương Rồng Nhồi Bông Có Nhạc, Biết Nhảy Biết M', 'Cây xương rồng nhảy múa vui nhộn sạc pin USB, chậu xương rồng uốn éo phát nhạc, nhại giọng nói. CHỨC NĂNG:- Cây xương rồng nhồi bông có thể nhảy múa, phát nhạc, di chuyển, quay xung quanh và có thể ghi âm. Cây xương rồng nhảy múa không chỉ là một món đồ chơi giải trí mà còn có', 1012057, '/public/images/products/product97/product97_main.jpg', NULL, NULL),
(98, 22, ' THÚ BÔNG CON THỎ CƯỜI CHÂN DÀI SIÊU CƯNG CHO BÉ -', '] GẤU BÔNG THỎ CƯỜI CHÂN DÀI SIÊU DỄ THƯƠNG - THÚ BÔNG CON THỎ CƯỜI. LƯU Ý KHI NHẬN HÀNG QUÝ KHÁCH VUI LÒNG QUAY LẠI VIDEO MỞ HÀNG NHA ĐỂ GIẢI QUYẾT KHI CÓ SỰ CỐ CẢM ƠN CÁC BẠN. SẢN PHẨM GỒM 1 GẤU BÔNG CON THỎ CƯỜI. THÔNG TIN SẢN PHẨM. KÍCH THƯỚC: SIZE DÀI', 281997, '/public/images/products/product98/product98_main.jpg', NULL, NULL),
(99, 22, 'Gấu Bông Mèo Hoàng Thượng Cao Cấp Memon, Mèo Bông ', 'Sản phẩm cao cấp chính hãng đường may bền đẹp với chất liệu lông xù mềm mịn co dãn 4 chiều, bông nhồi bên trong 100% là bông gòn 3D trắng tinh khiết loại 1, độ đàn hồi tốt, không gây ngứa, không rụng lông cực kỳ an toàn cho bé. Gấu bông Mèo', 822939, '/public/images/products/product99/product99_main.jpg', NULL, NULL),
(100, 22, 'Đồ chơi chó biết {HÁT NHẠC TIẾNG VIỆT}, biết lắc m', 'Những chú chó nhồi bông luôn là món đồ chơi rất gần gữi với các bé. THÔNG TIN SẢN PHẨM:. Kích thước : 25 x 30 cm. Chức năng : Chó nhồi bông có thể kêu gâu gâu, lắc mông và biết hát nhạc. ❹ Là quà tặng ý nghĩa cho bé yêu. Lắp pin AA đúng chiều. Bên cạnh', 448368, '/public/images/products/product100/product100_main.jpg', NULL, NULL),
(101, 21, 'Kệ tivi ', 'Không quá khi nói rằng việc xem tivi bây giờ không còn quan trọng như xưa khi chúng ta thường tập chung thưởng thức các trường trình trên điện thoại hay máy tính bảng. Dần dần công dụng chính của kệ tivi ngày càng ít đi.', 1515019, '/public/images/products/product101/product101_main.jpg', NULL, NULL),
(102, 21, 'Kệ gỗ đứng', 'Kệ gỗ đứng thường được dùng làm kệ sách, kệ đựng rượu hay tủ giày,.. tạo điểm nhấn cho phòng khách. Kệ đứng khá chắc chắn, có thể dễ dàng di chuyển sang các không gian khác. Ngoài ra, kệ còn có khả năng chịu lực lớn, chứa được nhiều sách và vật dụng. ', 1439241, '/public/images/products/product102/product102_main.jpg', NULL, NULL),
(103, 21, 'Kệ gỗ treo tường', 'Kệ gỗ treo tường giúp tận dụng được khoảng tường trống, lưu trữ nhiều vật dụng mà không chiếm quá nhiều diện tích, khiến căn phòng trở nên hài hòa, ấn tượng. Bên cạnh đó, kệ treo tường có giá thành phù hợp với nhiều gia đình. ', 658274, '/public/images/products/product103/product103_main.jpg', NULL, NULL),
(104, 21, 'Mẫu tủ đứng', 'Mẫu tủ đứng được thiết kế cách điệu mới lạ, mang phong cách cổ điển', 528545, '/public/images/products/product104/product104_main.jpg', NULL, NULL),
(105, 21, 'Kệ trang trí phòng khách', 'Kệ trang trí phòng khách sử dụng các thanh gỗ đan xen nhau tạo sự độc đáo, mới lạ', 543010, '/public/images/products/product105/product105_main.jpg', NULL, NULL),
(106, 21, 'Tủ TV góc Bevel', 'Tủ TV góc Bevel là mẫu kệ tivi mới nhất được đặc trưng bởi khung tủ giật cấp mang hơi hướng cổ điển, chân góc cạnh thanh lịch. Toàn bộ bề mặt tủ được sơn PU cao cấp, giúp bảo vệ lớp gỗ bên trong mà vẫn giữ nguyên được vẻ đẹp tự nhiên của gỗ sồi trắng Mỹ nhập khẩu. ', 1488190, '/public/images/products/product106/product106_main.jpg', NULL, NULL),
(107, 21, 'Kệ đời mới', 'Mẫu kệ tivi mới nhất Tủ TV Bụi mang phong cách trẻ trung, bụi bặm nhưng không quên giữ lại nét thô mộc của chất liệu gỗ thông. Gỗ thông nổi bật với chất lượng tốt, nhẹ và ít khi bị mối mọt vì trong gỗ có nhựa thông như 1 chất bảo quản tự nhiên, vân gỗ đẹp và đa dạng, độ bền cao giúp tối ưu hóa giá thành.', 542256, '/public/images/products/product107/product107_main.jpg', NULL, NULL),
(108, 21, 'Kệ đầu thu', 'Mẫu kệ tivi mới nhất Tủ TV 4 ngăn kéo Casa gỗ sồi đặc trưng bởi những viền cong mềm mại và đường xẻ rãnh trắng trang trí tinh tế. 4 hộc tủ, các ngăn chính giữa và cả bề mặt tủ là nơi bạn có thể bày biện, cất giữ đồ đạc. ', 137461, '/public/images/products/product108/product108_main.jpg', NULL, NULL),
(109, 21, 'Kệ gỗ chữ L treo đồ lưu niệm, quần áo gắn tường tr', 'Không những decor trang trí nhà cửa mà móc treo đồ còn rất nhiều công năng phải kể tới như : móc khóa , móc ô , treo quần áo, phụ kiện ,mũ nón, có thể treo ở bất cứ nơi đâu như phòng ngủ, phòng tắm, phòng ăn, lối ra vào nhà .. Giúp tiết kiệm rất nhiều không gian cho bạn', 664969, '/public/images/products/product109/product109_main.jpg', NULL, NULL),
(110, 21, 'Bộ kệ gỗ treo tường Anzzar để khung ảnh, đồ lưu ni', 'Kệ gỗ dùng để trang trí, để các đồ lưu niệm, đồ dùng nhà bếp, phụ kiện trong các phòng ngủ, phòng khách,nhà tắm, nhà bếp', 607389, '/public/images/products/product110/product110_main.jpg', NULL, NULL),
(111, 23, 'Chăn ga gối đệm Cotton Satin', 'Cotton satin không phải là một chất vải xa lạ, mới mẻ nào khác, mà chính là vải cotton nhưng có sợi chỉ được se nhỏ hơn với mật độ tầm 300 sợi/inch vuông. Nhờ đặc điểm cấu tạo này nên bề mặt của những bộ chăn ga gối đệm làm từ vải cotton satin khá mềm mỏng, mịn như lụa, mát như tơ tằm, thám hút mồ hôi cũng tốt và tuổi thọ sử dụng cũng rất lâu. Đó là lý do vì sao cotton satin rất được ưa chuộng sử dụng để may vỏ chăn ga gối đệm, được người tiêu dùng đón nhận nhiệt tình.', 1540919, '/public/images/products/product111/product111_main.jpg', NULL, NULL),
(112, 23, 'Chăn ga gối đệm lụa Tencel', 'So với các dòng sản phẩm đã được liệt kê và phân tích ở trên, chăn ga gối đệm làm từ lụa tencel sở hữu đặc tính và cấu tạo rất khác biệt. Mặc dù chất vải này có khá nhiều đặc điểm chung với vải cotton, về độ mềm mại, thấm hút mồ hôi tốt... nhưng nó lại được yêu thích và đánh giá cao hơn nhờ “tích hợp” thêm một số ưu điểm đắt giá khác như: không bị co rút sợi, không nhăn sau khi giặt, rất thoáng khí và không hề có bụi vải, cực kỳ thích hợp nếu bạn bị viêm xoang, viêm mũi dị ứng... ', 1307866, '/public/images/products/product112/product112_main.jpg', NULL, NULL),
(113, 23, 'Chăn bộ', 'Bedding set tông màu trơn nhẹ nhàng với đường chần đẹp và lạ mắt dọc suốt theo chăn tạo điểm nhấn căn phòng. Với 100% COTTON mịn thoáng mát giúp bạn có giấc ngủ ngon và sảng khoái.', 572473, '/public/images/products/product113/product113_main.jpg', NULL, NULL),
(114, 23, 'Bộ Chăn Ga Gối Lụa Tencel 60s – TC09', 'Bộ Chăn Ga Gối Lụa Tencel 60s được xem như một dòng sản phẩm cao cấp, chất lượng và được nhiều gia đình ưa chuộng sử dụng. Với bề mặt vải mịn màng, mát lạnh. Hoàn toàn không có bụi lông, mùi khó chịu, an toàn cho hệ hô hấp. Đối với việc trang trí cho nội thất không gian phòng ngủ không chỉ đạt tiêu chuẩn về thẩm mỹ mà còn đảm bảo an toàn về sức khỏe cho người sử dụng.', 226194, '/public/images/products/product114/product114_main.jpg', NULL, NULL),
(115, 23, 'Ga Chống Thấm Mẫu Heo Đất', 'Mặt phải của Ga chống thấm Goodmama được làm từ vải sợi 100% cotton với các hình họa bắt mắt ( Được nhập nguyên liệu từ các nhà máy lớn chuyên cung cấp vải cho các hãng sản xuất chăn ga gối đệm lớn tại Việt Nam). Vải 100% cotton giúp ga có thể thấm hút mồ hôi, giải phóng nhiệt năng ngay tại thời điểm cơ thể chúng ta tiết xuất ra mồ hôi và được lớp vải hút thấm lượng mồ hôi đó, tạo nên sự thoáng mát ưu việt, thân thiện với làn da ngay cả da nhạy cảm.', 1767167, '/public/images/products/product115/product115_main.jpg', NULL, NULL),
(116, 23, 'Bộ Artemis ASHM-21102', 'gam màu chủ đạo là ghi đá. Chất liệu vải được tạo nên từ sơ vỏ cây dâu tằm kết hợp với gỗ sồi (Modal). Vẫn là vải Modal nhưng có những đặc tính cao cấp vượt trội hơn hẳn: mịn màng, mềm mại, trao đổi khí tốt.', 574474, '/public/images/products/product116/product116_main.jpg', NULL, NULL),
(117, 23, 'Bộ Artemis ASHM-23101', 'Chất lượng cuộc sống được phản ánh qua rất nhiều yếu tố, khía cạnh. Nhưng có lẽ, có một yếu tố mà nhiều người chưa thực sự chú trọng, đó là phòng ngủ. Phòng ngủ là nơi thể hiện được chất lượng giấc ngủ của gia chủ, thể hiện được phong cách cá nhân của họ. Với những người yêu thích sự trang nhã, hài hòa, thanh lịch, chắc có lẽ không thể làm ngơ trước mẫu chăn ga gối ASHM 23101. Cùng chúng tôi tìm hiểu chi tiết nhé!', 1146895, '/public/images/products/product117/product117_main.jpg', NULL, NULL),
(118, 23, 'Bộ Artemis ASHM-23103', 'Sở hữu tông màu chủ đạo hồng phấn, Bộ chăn ga gối Artemis ASHM-23103 khiến không gian như trở nên bừng sáng, hài hòa, tuy đơn giản nhưng lại vô cùng nổi bật.', 489469, '/public/images/products/product118/product118_main.jpg', NULL, NULL),
(119, 23, 'Bộ Artemis As1802', 'à bộ chăn ga gối đệm thích hợp đặt vào phòng tân hôn của các cặp đôi mới cưới. Với gam màu đỏ lấy làm chủ đạo bộ chăn ga gối đệm này thể hiện tình yêu mãnh liệt, cháy bỏng gắn kết tình yêu đôi lứa khi họ về chung một nhà.', 363653, '/public/images/products/product119/product119_main.jpg', NULL, NULL),
(120, 23, 'Bộ Artemis ASHM-21102', 'AShm-21102 gam màu chủ đạo là ghi đá. Chất liệu vải được tạo nên từ sơ vỏ cây dâu tằm kết hợp với gỗ sồi (Modal). Vẫn là vải Modal nhưng có những đặc tính cao cấp vượt trội hơn hẳn: mịn màng, mềm mại, trao đổi khí tốt.', 738916, '/public/images/products/product120/product120_main.jpg', NULL, NULL),
(121, 20, 'Tranh hổ phách “Bình minh trên dòng sông” ', 'Tranh hổ phách “Bình minh trên dòng sông” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1791260, '/public/images/products/product121/product121_main.jpg', NULL, NULL),
(122, 20, 'Tranh hổ phách “Tàu №7”', 'Tranh hổ phách “Tàu №7” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1461596, '/public/images/products/product122/product122_main.jpg', NULL, NULL),
(123, 20, 'Bức tranh “Bird The Hoopoe, Autumn”', 'Bức tranh “Bird The Hoopoe, Autumn” được làm bằng hổ phách Baltic tự nhiên ở Nga. Để gia công một bức tranh, người ta sử dụng đá hổ phách tự nhiên nhiều kích cỡ và màu sắc khác nhau được khai thác ở Kaliningrad. Để tạo ra một bức tranh, người thợ cần phải làm việc miệt mài một tuần. Bạn có thể mua bức tranh này và những bức tranh khác tại cửa hàng của chúng tôi tại Hà Nội.', 1240645, '/public/images/products/product123/product123_main.jpg', '26x24x12', 'Gỗ'),
(124, 20, 'Bức tranh “Flowers on glass”', 'Bức tranh “Flowers on glass” được làm bằng hổ phách Baltic tự nhiên ở Nga. Để gia công một bức tranh, người ta sử dụng đá hổ phách tự nhiên nhiều kích cỡ và màu sắc khác nhau được khai thác ở Kaliningrad. Để tạo ra một bức tranh, người thợ cần phải làm việc miệt mài một tuần. Bạn có thể mua bức tranh này và những bức tranh khác tại cửa hàng của chúng tôi tại Hà Nội.', 490919, '/public/images/products/product124/product124_main.jpg', NULL, NULL),
(125, 20, 'Tranh hươu', 'Tranh hươu ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1450811, '/public/images/products/product125/product125_main.jpg', '26x54x12', 'Gỗ'),
(126, 20, 'Tranh hổ phách “Chuyện tình” ', 'Tranh hổ phách “Chuyện tình” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1551585, '/public/images/products/product126/product126_main.jpg', '56x54x12', 'Gỗ'),
(127, 20, 'Tranh hổ phách “Liễu bằng nước”', 'Tranh hổ phách “Liễu bằng nước” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 155925, '/public/images/products/product127/product127_main.jpg', '25x87x10', 'Gỗ'),
(128, 20, 'Tranh hổ phách “Sư tử vua thú dữ”', 'Tranh hổ phách “Sư tử vua thú dữ” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1161438, '/public/images/products/product128/product128_main.jpg', '54x56x21', 'Gỗ'),
(129, 20, 'Bức tranh “The Falcon On The Hunt” ', 'Bức tranh “The Falcon On The Hunt” được làm bằng hổ phách Baltic tự nhiên ở Nga. Để gia công một bức tranh, người ta sử dụng đá hổ phách tự nhiên nhiều kích cỡ và màu sắc khác nhau được khai thác ở Kaliningrad. Để tạo ra một bức tranh, người thợ cần phải làm việc miệt mài một tuần. Bạn có thể mua bức tranh này và những bức tranh khác tại cửa hàng của chúng tôi tại Hà Nội.', 1143472, '/public/images/products/product129/product129_main.jpg', '56x54x12', 'Gỗ'),
(130, 20, 'Tranh hổ phách “Thiên đường”', 'Tranh hổ phách “Thiên đường” ngay lập tức thay đổi không khí trong phòng, thêm sự ấm áp và thoải mái cho nội thất của bạn. Hổ phách tự nhiên hoàn toàn phù hợp với bất kỳ nội thất nào, tăng thêm sự sang trọng và lộng lẫy cho căn phòng. Không quan trọng tranh hổ phách sẽ được đặt ở phòng nào, vì ở mọi nơi nó sẽ làm hài lòng bất kỳ ai nhìn vào nó. Hổ phách biến đổi tranh – đây là một cái nhìn mới về nghệ thuật.', 1293728, '/public/images/products/product130/product130_main.jpg', '54x56x21', 'Gỗ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `ID_Product` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_SC` int(11) NOT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `shoppingcart`
--

INSERT INTO `shoppingcart` (`ID_Product`, `ID_User`, `ID_SC`, `Amount`) VALUES
(130, 1, 1, 1),
(114, 1, 2, 1),
(128, 2, 9, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `Name_User` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Phone` char(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Email` char(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Address` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(65) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `level` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `verify` char(0) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `regtime` int(11) DEFAULT NULL,
  `salt` varchar(32) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID_User`, `Name_User`, `Phone`, `Email`, `Address`, `password`, `level`, `verify`, `regtime`, `salt`) VALUES
(1, NULL, NULL, 'nguyentantaitcag2000@yahoo.com', NULL, 'c09a27302fc405b0279f94ee1c2daa07963e90aee266bc1ad4fdd046defc99a1', 'user', NULL, 1676557969, 'BhcGKmxdpfuTLsDI7zv4i5kY9oFPlSgC'),
(2, NULL, NULL, 'khachhang@gmail.com', 'Khu 2, Đ. 3/2, P. Xuân Khánh, Q. Ninh Kiều, TP. CT', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, 1677726707, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`ID_Bill`),
  ADD KEY `fk_ksdajf` (`ID_BS`),
  ADD KEY `fk_sldjsdlj` (`ID_MOB`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD KEY `fk_dsad` (`ID_Product`),
  ADD KEY `fk_skjdk` (`ID_Bill`);

--
-- Chỉ mục cho bảng `bill_status`
--
ALTER TABLE `bill_status`
  ADD PRIMARY KEY (`ID_BS`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ID_Color`);

--
-- Chỉ mục cho bảng `detail_product_color`
--
ALTER TABLE `detail_product_color`
  ADD PRIMARY KEY (`ID_DPC`),
  ADD KEY `FK_DSACUA` (`ID_Color`),
  ADD KEY `FK_CUADA` (`ID_Product`);

--
-- Chỉ mục cho bảng `detail_product_image`
--
ALTER TABLE `detail_product_image`
  ADD PRIMARY KEY (`ID_DPI`),
  ADD KEY `fk_sdkjaskdjadkad` (`ID_Product`);

--
-- Chỉ mục cho bảng `export_history`
--
ALTER TABLE `export_history`
  ADD PRIMARY KEY (`ID_EH`),
  ADD KEY `FK_EXPORT_H_CXCO_BILL` (`ID_Bill`);

--
-- Chỉ mục cho bảng `import_history`
--
ALTER TABLE `import_history`
  ADD PRIMARY KEY (`ID_IH`),
  ADD KEY `FK_IMPORT_H_CCO_BILL` (`ID_Bill`);

--
-- Chỉ mục cho bảng `methodofpayment`
--
ALTER TABLE `methodofpayment`
  ADD PRIMARY KEY (`ID_MOB`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`Name`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID_Product`),
  ADD KEY `fk_sdjadkj` (`ID_Category`);

--
-- Chỉ mục cho bảng `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`ID_SC`),
  ADD KEY `FK_CO2` (`ID_Product`),
  ADD KEY `FK_CUA` (`ID_User`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `ID_Bill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `bill_status`
--
ALTER TABLE `bill_status`
  MODIFY `ID_BS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `ID_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `ID_Color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `detail_product_color`
--
ALTER TABLE `detail_product_color`
  MODIFY `ID_DPC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT cho bảng `detail_product_image`
--
ALTER TABLE `detail_product_image`
  MODIFY `ID_DPI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `export_history`
--
ALTER TABLE `export_history`
  MODIFY `ID_EH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import_history`
--
ALTER TABLE `import_history`
  MODIFY `ID_IH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `methodofpayment`
--
ALTER TABLE `methodofpayment`
  MODIFY `ID_MOB` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT cho bảng `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `ID_SC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_ksdajf` FOREIGN KEY (`ID_BS`) REFERENCES `bill_status` (`ID_BS`),
  ADD CONSTRAINT `fk_sldjsdlj` FOREIGN KEY (`ID_MOB`) REFERENCES `methodofpayment` (`ID_MOB`);

--
-- Các ràng buộc cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `fk_dsad` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`),
  ADD CONSTRAINT `fk_skjdk` FOREIGN KEY (`ID_Bill`) REFERENCES `bill` (`ID_Bill`);

--
-- Các ràng buộc cho bảng `detail_product_color`
--
ALTER TABLE `detail_product_color`
  ADD CONSTRAINT `FK_CUADA` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DSACUA` FOREIGN KEY (`ID_Color`) REFERENCES `color` (`ID_Color`);

--
-- Các ràng buộc cho bảng `detail_product_image`
--
ALTER TABLE `detail_product_image`
  ADD CONSTRAINT `fk_sdkjaskdjadkad` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`);

--
-- Các ràng buộc cho bảng `export_history`
--
ALTER TABLE `export_history`
  ADD CONSTRAINT `FK_EXPORT_H_CXCO_BILL` FOREIGN KEY (`ID_Bill`) REFERENCES `bill` (`ID_Bill`);

--
-- Các ràng buộc cho bảng `import_history`
--
ALTER TABLE `import_history`
  ADD CONSTRAINT `FK_IMPORT_H_CCO_BILL` FOREIGN KEY (`ID_Bill`) REFERENCES `bill` (`ID_Bill`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_sdjadkj` FOREIGN KEY (`ID_Category`) REFERENCES `category` (`ID_Category`);

--
-- Các ràng buộc cho bảng `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `FK_CO2` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`),
  ADD CONSTRAINT `FK_CUA` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
