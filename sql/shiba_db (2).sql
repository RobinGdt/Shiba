-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 20 mai 2022 à 06:58
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shiba_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text NOT NULL,
  `date_time_publication` datetime NOT NULL,
  `date_time_edition` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `token`, `titre`, `contenu`, `date_time_publication`, `date_time_edition`) VALUES
(2, '', '            Deuxième message bis 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio doloremque, nobis necessitatibus exercitationem natus quas quae, laudantium perferendis quasi quaerat ea beatae quos pariatur voluptatibus nihil fugiat deserunt. Velit, eius.\r\nHic quisquam cum, id eveniet voluptas, suscipit provident vel voluptatum ab delectus fugit! Minus, ex! Ea eos rerum dolorum saepe modi? Dolorum illo quis, ratione doloremque hic voluptatum eius iste.\r\nPlaceat praesentium adipisci magni quia, facilis perferendis atque, hic eos, id eum consequatur nulla omnis? Tempore, expedita impedit veniam voluptate voluptatum quam explicabo dignissimos facere similique voluptates sit aliquam excepturi.\r\nEveniet accusantium aliquid dolore ratione ad, impedit eligendi aperiam quae ab omnis ut error vel recusandae. Cumque iusto ullam, consequatur nisi doloremque fugiat labore, libero blanditiis, animi rerum facere quisquam.\r\nAdipisci, ratione. Error totam consequuntur nostrum optio omnis, distinctio aspernatur cumque, molestias incidunt id quae! Odit quo molestiae officiis? Natus sapiente quos porro fuga numquam voluptas ratione quae maiores molestiae.', '2022-05-09 12:33:39', '2022-05-09 17:36:43'),
(8, '', '            Augustin', 'Lorem ipsum dolor sit amet. Et inventore itaque sit iusto distinctio cum nulla animi aut quae distinctio cum labore maxime ea nostrum dolorem. Ab omnis officiis sed voluptatem magni quo tempora consequatur in facilis commodi qui expedita dolor ut ipsam voluptatum aut impedit accusantium.', '2022-05-09 18:59:19', '2022-05-11 12:25:02'),
(9, '', 'Augustin', 'ok je m\'en branle quand même en fait', '2022-05-10 15:21:24', '2022-05-10 15:21:24'),
(10, '0d88985883a87308a094c2bfe8ba50a7a20942698cf8105c5049f288242fc56027193d86186b9b4290b0d54b5aa6661173b98ff14432fe7603c1b278c5158be3', '           Steven', 'ok c bon', '2022-05-18 10:42:45', '2022-05-18 10:42:45'),
(11, '0d88985883a87308a094c2bfe8ba50a7a20942698cf8105c5049f288242fc56027193d86186b9b4290b0d54b5aa6661173b98ff14432fe7603c1b278c5158be3', 'message', 'voici esfqdx', '2022-05-18 11:37:51', '2022-05-18 11:37:51'),
(12, '0d88985883a87308a094c2bfe8ba50a7a20942698cf8105c5049f288242fc56027193d86186b9b4290b0d54b5aa6661173b98ff14432fe7603c1b278c5158be3', 'message', 'voici esfqdx', '2022-05-18 11:37:58', '2022-05-18 11:37:58'),
(39, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', NULL, 'wsfsxbv', '2022-05-19 12:21:50', '2022-05-19 12:21:50'),
(40, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', NULL, 'azqposjfl', '2022-05-19 12:23:25', '2022-05-19 12:23:25'),
(41, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', NULL, 'Hello comment vas-tu ??', '2022-05-19 14:04:38', '2022-05-19 14:04:38'),
(42, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', NULL, 'MMMMMMH le caca c\'est délicieux', '2022-05-19 23:21:38', '2022-05-19 23:21:38');

-- --------------------------------------------------------

--
-- Structure de la table `candid_group`
--

CREATE TABLE `candid_group` (
  `id` int(11) NOT NULL,
  `tokenGroup` varchar(255) NOT NULL,
  `tokenID` varchar(255) NOT NULL,
  `state` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL DEFAULT 'NOT NULL',
  `commentaires` text NOT NULL,
  `id_article` int(11) NOT NULL,
  `date_time_comment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `pseudo`, `commentaires`, `id_article`, `date_time_comment`) VALUES
(33, 'Augustin', 'coucou les petites pepettes ^^\'', 8, '2022-05-10 15:20:14'),
(87, 'NOT NULL', 'hello', 41, '2022-05-19 15:25:46'),
(88, 'NOT NULL', 'comment allez vous?', 41, '2022-05-19 15:25:57'),
(89, 'NOT NULL', 'comment allez vous?', 41, '2022-05-19 15:26:00'),
(90, 'NOT NULL', 'coucou', 41, '2022-05-19 15:34:38'),
(92, 'NOT NULL', 'hello toi', 41, '2022-05-19 21:49:53'),
(93, 'NOT NULL', 'Trop mignon ce chat &lt;3333', 42, '2022-05-19 23:21:55');

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_article`, `id_membre`) VALUES
(8, 8, NULL),
(9, 8, NULL),
(10, 42, NULL),
(11, 42, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dislikes_com`
--

CREATE TABLE `dislikes_com` (
  `id` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dislikes_com`
--

INSERT INTO `dislikes_com` (`id`, `id_com`, `id_membre`) VALUES
(1, 33, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `tokenID` varchar(255) NOT NULL,
  `tokenFriend` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`id`, `tokenID`, `tokenFriend`, `date`) VALUES
(166, 'f21d6d1e303f3736756841c3f5668972053f03fdfaa4233e5cdf79140e35069fb813f09acadb509090e2c81904fb934637404a9aedb18141f4e2bd568a8e828b', 'e109df77b22fd5a114a91c62e93c3c501d1761edc5e3513f7895968cc2be9ce4d71a1fb5c865657fb2b3b529a4f3e1b98c9b74a561b67a2873d4cc5249f319c0', '2022-05-18'),
(167, 'e109df77b22fd5a114a91c62e93c3c501d1761edc5e3513f7895968cc2be9ce4d71a1fb5c865657fb2b3b529a4f3e1b98c9b74a561b67a2873d4cc5249f319c0', 'f21d6d1e303f3736756841c3f5668972053f03fdfaa4233e5cdf79140e35069fb813f09acadb509090e2c81904fb934637404a9aedb18141f4e2bd568a8e828b', '2022-05-18'),
(170, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', 'c7b399fcf22a6a13f6bfdcf560b9d721cd4053fc5cfee53427ad46efd930b94f96a4ef761c85f2bfcbdd12783ff269ed2d5688210875d767c39a1339813ce22e', '2022-05-19'),
(171, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '32af33bb95778347f89d9fc8a3d7f91412650a607c6a9011f2e0a791e2a97fbf3a7d6c4304a056aa47db0c5cda65b3e5cd778f9a63410508a6df88c7f3dbafd6', '2022-05-19'),
(172, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '799479f5dd5f10a0b6cf51b0f3bb9c06572b8353a7d4e9c302fb37c3f6c1035cf5f28530a15b0a764357dc9027382b77c5d44b407ffe7c9ef186b7c6cd11b722', '2022-05-19'),
(173, 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '4c97e63fe2e3cc23ba19fe9f4da0438d026bff184b1182f6a96809203aba009e0174f1fb89709e87e944d68205ce0a5a6340fc224b605214cd822a371ca9e145', '2022-05-19');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `tokenGroup` varchar(255) NOT NULL,
  `nameGroup` varchar(255) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `state` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `tokenGroup`, `nameGroup`, `description`, `state`, `date`) VALUES
(11, '2e25bf426f7470591fbf17dfba1c7aa00208ef88c84e36add18d50e90a14e964e71589122cfcffdf25321ce8c9e9f7526a2f8c9b876eae5cc7bf4203a4c9f9f9', 'coucou', 'ça va ?', 0, '2022-05-19');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_article`, `id_membre`) VALUES
(1, 8, NULL),
(26, 8, NULL),
(27, 8, NULL),
(28, 42, NULL),
(29, 42, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `likes_com`
--

CREATE TABLE `likes_com` (
  `id` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes_com`
--

INSERT INTO `likes_com` (`id`, `id_com`, `id_membre`) VALUES
(1, 33, NULL),
(2, 33, NULL),
(3, 33, NULL),
(4, 33, NULL),
(5, 33, NULL),
(6, 33, NULL),
(7, 33, NULL),
(8, 33, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `members_group`
--

CREATE TABLE `members_group` (
  `id` int(11) NOT NULL,
  `tokenGroup` varchar(255) NOT NULL,
  `tokenID` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members_group`
--

INSERT INTO `members_group` (`id`, `tokenGroup`, `tokenID`, `admin`, `date`) VALUES
(28, '2e25bf426f7470591fbf17dfba1c7aa00208ef88c84e36add18d50e90a14e964e71589122cfcffdf25321ce8c9e9f7526a2f8c9b876eae5cc7bf4203a4c9f9f9', 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', 1, '2022-05-19');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `token_receveur` varchar(255) NOT NULL,
  `token_envoyeur` varchar(255) NOT NULL,
  `message_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `message`, `token_receveur`, `token_envoyeur`, `message_timestamp`) VALUES
(1, 'coucou', '8', '2', '2022-05-18 14:01:08'),
(2, 'Oui et toi ?\r\n', '6', '2', '2022-05-18 14:01:19'),
(3, 'ça va ?', '8', '2', '2022-05-18 14:06:23'),
(4, 'Coucou jp', 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '32af33bb95778347f89d9fc8a3d7f91412650a607c6a9011f2e0a791e2a97fbf3a7d6c4304a056aa47db0c5cda65b3e5cd778f9a63410508a6df88c7f3dbafd6', '2022-05-18 19:37:03'),
(5, 'coucou allo\r\n', '32af33bb95778347f89d9fc8a3d7f91412650a607c6a9011f2e0a791e2a97fbf3a7d6c4304a056aa47db0c5cda65b3e5cd778f9a63410508a6df88c7f3dbafd6', 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '2022-05-19 08:58:26');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `pages_id` int(11) NOT NULL,
  `pages_name` varchar(255) NOT NULL,
  `pages_contain` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`pages_id`, `pages_name`, `pages_contain`, `user_id`) VALUES
(25, 'Quelles gerbes et quels crépitements', 'Jure-moi de travailler avec toi ! Imagine-toi : toi au sommet du tronc en forme de coupe, les menaçant des plus rigoureuses vengeances de l\'idéal. Celle-là s\'était desséchée dans l\'air chaud, nauséabond, m\'a fait l\'objet du présent volume est nécessairement imparfait. Gardez cela pour vous, ce qui ravit avant tout, elle avait retrouvé le sourire et le profil était noble, mon amour, je n\'ignorais pas ma secrète indépendance. Colonel, je ne savais comment dissiper la méfiance qu\'elle aurait pour moi pourraient vous faire agir dans telles ou telles causes. Dites-vous vos prières matin et soir. Canaille mal née et mal-apprise. Seize douairières, dix sages femelles célibataires, deux ou trois gredins qui tenaient des jumelles comme à l\'époque la plus reculée du couvent se trouve une barrière qui se trouvait fermée.\r\n', 17),
(30, 'Volume à volume toute', 'Émerveillés furent les astronomes quand, après avoir, sans plus. Gaieté alarmante, eu égard aux efforts accomplis en faveur d\'une vie bien douce et bien timbrée, sortie d\'excellents poumons. Concluons-en que ce péché de psychologie dont les romanciers d\'analyse ont été si loin d\'ici, troupe coiffée, inutile pour toute humaine récréation. Suspendez, ô seigneurs, reprit le premier, ce qu\'un inventeur soit arrivé du premier coup de marteau est adouci par le manche de mon porte-plume, je puisai une grosse goutte d\'encre, disaient-ils très exactement. Verser traîtreusement dans son âme qu\'il applaudit aux cloches, dont la cheminée, elle le remit à un autre et étant célibataire, je pouvais régénérer mon tissu nerveux. Écris toi-même le mieux que je me serve de mon bien je fis une sérieuse trouée dans le flot de foule encombrait la porte. Ç\'allait être la mort comme il l\'appelait, qui l\'aurait la briserait en morceaux, un seul pouvait-il révéler au-dehors la vie intérieure nous possédons une certitude qui nous est propre. Voudrais-tu lui couper la gorge, puisqu\'il y a ?\r\n', 12),
(31, 'Désirée avait fini par être fatigués ', 'Cachez-vous vite sous ce fourneau, et il devait se sentir bien seul à la fonte. Permettez-vous que je vous perds, nous nous rencontrons, nu et encombré de désordre, en cherchant à pénétrer le labeur immense de ce petit lac central. Associez-vous avec un poète ou un musicien à confondre les mots divers du livret dans un même lieu. Anglais, tu sais aussi ce que nous éprouvons par les vices de leur père. Attaquer cette porte à clef, retourna en vacillant sur le canapé rose. Représentez-vous tout autour une espèce de fermier des ruines. Rendre la cuve, où l\'oeil plongeait dans la douve, j\'ai poussé un soupir de satisfaction, le régime corporatif ; pour l\'autre monde, ils augmentent leurs richesses. Notez que la révolution est consommée, on se transporterait à une société close.\r\n', 17),
(33, 'page1', 'voici le contenu', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pages_assign`
--

CREATE TABLE `pages_assign` (
  `user_id` int(11) NOT NULL,
  `pages_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pages_assign`
--

INSERT INTO `pages_assign` (`user_id`, `pages_id`) VALUES
(19, 5);

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE `profiles` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ImgProfile` varchar(255) DEFAULT NULL,
  `ImgBanner` varchar(255) DEFAULT NULL,
  `tokenID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profiles`
--

INSERT INTO `profiles` (`ID`, `name`, `lastname`, `age`, `gender`, `birthday`, `phone`, `ImgProfile`, `ImgBanner`, `tokenID`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '799479f5dd5f10a0b6cf51b0f3bb9c06572b8353a7d4e9c302fb37c3f6c1035cf5f28530a15b0a764357dc9027382b77c5d44b407ffe7c9ef186b7c6cd11b722'),
(2, 'Robin', 'Godart', 25, NULL, '2022-05-27', '+33782255092', 'GitHub-Mark.png', 'sdf_dort.jpeg', 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, 'githublogo.jpg', 'cat_golri.jpeg', '4c97e63fe2e3cc23ba19fe9f4da0438d026bff184b1182f6a96809203aba009e0174f1fb89709e87e944d68205ce0a5a6340fc224b605214cd822a371ca9e145'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a715b2896c0cb86b1a97921a0e4a47ed5c4bff266b35890b83c9e3facd2a288b2adfebc421abe388cd1eaffdee1a2c52c091311290b3fdbb81ae8ff229264bc1'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0d88985883a87308a094c2bfe8ba50a7a20942698cf8105c5049f288242fc56027193d86186b9b4290b0d54b5aa6661173b98ff14432fe7603c1b278c5158be3'),
(6, 'steven', 'wara', 34, NULL, NULL, NULL, NULL, NULL, 'da7c921fb4136639243865d068fe70bca1fda05899e9cff702cbaec7eb49267aa48451c6d40bff8ddc48cfffd4b1ff10458c15cedd45f7fdff58f9c064c1183d'),
(7, 'Allo', 'tamer', 8, 'homme', '2022-05-14', '', 'GitHub-Mark.png', NULL, '32af33bb95778347f89d9fc8a3d7f91412650a607c6a9011f2e0a791e2a97fbf3a7d6c4304a056aa47db0c5cda65b3e5cd778f9a63410508a6df88c7f3dbafd6'),
(8, 'bonjour', 'au revoir', 112, 'femme', '2022-05-25', '', 'pixel_cat.jpeg', NULL, 'c7b399fcf22a6a13f6bfdcf560b9d721cd4053fc5cfee53427ad46efd930b94f96a4ef761c85f2bfcbdd12783ff269ed2d5688210875d767c39a1339813ce22e'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1579de69ad36f4367630bd9fb6193ebeaa0df2b9dba280f31400ef1020462ad6ae349bfe90afcd8d1917d0953f084d7e6e691c95cb2a34cb898bbbc6fc18eeba');

-- --------------------------------------------------------

--
-- Structure de la table `publication_group`
--

CREATE TABLE `publication_group` (
  `id` int(11) NOT NULL,
  `tokenGroup` varchar(255) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `Img` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `contenu` text NOT NULL,
  `id_commentaire` text NOT NULL,
  `id_article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `token`, `date_inscription`) VALUES
(1, 'Robin', 'robin@gmail.com', '$2y$12$vcVvv9t6TBhUcK8O1xQT2eOPSFcqU4o.gN5Fmwx0gew7Ft8Tgd5gm', '799479f5dd5f10a0b6cf51b0f3bb9c06572b8353a7d4e9c302fb37c3f6c1035cf5f28530a15b0a764357dc9027382b77c5d44b407ffe7c9ef186b7c6cd11b722', '2022-05-13 14:45:09'),
(2, 'Jp', 'root@gmail.com', '$2y$12$zz7VWF8tLSjCGa4Z5YvrlO6YrkLJ2/5Lgo7iDDK90IuO84cWxgOKy', 'ec827472905f7929e599839deacdf00be4e58a7b284da6da7423a9c51f84e13ab3e58dc6a32873c4ff371f8d33c12e007860ab802c6ea0ebdb58fce97321417c', '2022-05-13 17:06:25'),
(3, 'Robine', 'robine@gmail.com', '$2y$12$PALJxBB5MQQEayR5iJ/jb.CBGaiF38CjzlwNHc7X40fDK1MiI0M7u', '4c97e63fe2e3cc23ba19fe9f4da0438d026bff184b1182f6a96809203aba009e0174f1fb89709e87e944d68205ce0a5a6340fc224b605214cd822a371ca9e145', '2022-05-16 14:15:23'),
(4, 'rootine', 'rootine@gmail.com', '$2y$12$QmgeEyod911rgKasA9RGO.cfSRzVGzXo.u98TBfjAViLJcDTkCOwu', 'a715b2896c0cb86b1a97921a0e4a47ed5c4bff266b35890b83c9e3facd2a288b2adfebc421abe388cd1eaffdee1a2c52c091311290b3fdbb81ae8ff229264bc1', '2022-05-16 14:58:13'),
(5, 'Zin', 'zin@gmail.com', '$2y$12$dntUD0ni7KER7AbX7d1EseMENFiCOOD4KWtb7dkHTqDfv0ox3k8WC', '0d88985883a87308a094c2bfe8ba50a7a20942698cf8105c5049f288242fc56027193d86186b9b4290b0d54b5aa6661173b98ff14432fe7603c1b278c5158be3', '2022-05-18 11:03:50'),
(7, 'allo', 'allo@gmail.com', '$2y$12$x8SNhcfeA5lpIbWsYnJWWezJkA9IleoawKCar.8EnDgriNW8QypVu', '32af33bb95778347f89d9fc8a3d7f91412650a607c6a9011f2e0a791e2a97fbf3a7d6c4304a056aa47db0c5cda65b3e5cd778f9a63410508a6df88c7f3dbafd6', '2022-05-18 21:30:52'),
(8, 'bonjour', 'bonjour@gmail.com', '$2y$12$FQW6LJSJI81.fT4Cfnj4DOtZl6aoLXaFVNhCCb3kFdTvswyqbKXmy', 'c7b399fcf22a6a13f6bfdcf560b9d721cd4053fc5cfee53427ad46efd930b94f96a4ef761c85f2bfcbdd12783ff269ed2d5688210875d767c39a1339813ce22e', '2022-05-19 16:36:28'),
(9, 'salut', 'salut@hotmail.com', '$2y$12$xJ74jwgRHMjNIy4bpUevMeEvqiQM9eKI0RVtjLZjkli9AtEUyK/xy', '1579de69ad36f4367630bd9fb6193ebeaa0df2b9dba280f31400ef1020462ad6ae349bfe90afcd8d1917d0953f084d7e6e691c95cb2a34cb898bbbc6fc18eeba', '2022-05-20 08:55:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `candid_group`
--
ALTER TABLE `candid_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokenGroup` (`tokenGroup`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dislikes_com`
--
ALTER TABLE `dislikes_com`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`tokenGroup`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes_com`
--
ALTER TABLE `likes_com`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members_group`
--
ALTER TABLE `members_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `tokenGroup` (`tokenGroup`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pages_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `publication_group`
--
ALTER TABLE `publication_group`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `candid_group`
--
ALTER TABLE `candid_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `dislikes_com`
--
ALTER TABLE `dislikes_com`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `likes_com`
--
ALTER TABLE `likes_com`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `members_group`
--
ALTER TABLE `members_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `publication_group`
--
ALTER TABLE `publication_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candid_group`
--
ALTER TABLE `candid_group`
  ADD CONSTRAINT `candid_group_ibfk_1` FOREIGN KEY (`tokenGroup`) REFERENCES `groups` (`tokenGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `members_group`
--
ALTER TABLE `members_group`
  ADD CONSTRAINT `members_group_ibfk_1` FOREIGN KEY (`tokenGroup`) REFERENCES `groups` (`tokenGroup`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
