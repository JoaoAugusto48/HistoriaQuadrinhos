INSERT INTO `ambientes` (`id`, `fundo`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'ambiente/ambiente1.png', 'ambiente1', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(2, 'ambiente/ambiente2.png', 'ambiente2', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(3, 'ambiente/ambiente3.png', 'ambiente3', '2020-07-13 17:09:45', '2020-07-13 17:09:45');

INSERT INTO `personagems` (`id`, `personagem`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'personagem/personagem1.png', 'personagem1', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(2, 'personagem/personagem2.png', 'personagem2', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(3, 'personagem/personagem3.png', 'personagem3', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(4, 'personagem/personagem4.png', 'personagem4', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(5, 'personagem/personagem5.png', 'personagem5', '2020-07-13 17:09:45', '2020-07-13 17:09:45');

INSERT INTO `balaos` (`id`, `caminho`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'balao/balaoDireita1.png', 'balao1', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(2, 'balao/balaoDireita2.png', 'balao2', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(3, 'balao/balaoEsquerda1.png', 'balao3', '2020-07-13 17:09:45', '2020-07-13 17:09:45'),
(4, 'balao/balaoEsquerda2.png', 'balao4', '2020-07-13 17:09:45', '2020-07-13 17:09:45');

INSERT INTO `utensilios` (`id`, `caminho`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'utensilio/utensilio1.png', 'cadeira1', '2020-08-05 13:48:35', '2020-08-05 13:48:35'),
(2, 'utensilio/utensilio2.png', 'cadeira2', '2020-08-05 13:48:35', '2020-08-05 13:48:35'),
(3, 'utensilio/utensilio3.png', 'cadeira3', '2020-08-05 13:50:04', '2020-08-05 13:50:04');

INSERT INTO `quadrinhopersonagens` (`id`, `balaoEsquerda`, `balaoDireita`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2020-08-05 13:48:35', '2020-08-05 13:48:35');