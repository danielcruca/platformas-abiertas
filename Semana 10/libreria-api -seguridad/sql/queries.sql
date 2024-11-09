CREATE TABLE tokens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    token VARCHAR(255) NOT NULL,
    expires_at DATETIME, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO tokens (token, expires_at) VALUES
('d3b07384d113edec49eaa6238ad5ff00', '2024-11-10 12:00:00'),
('6f1ed002ab5595859014ebf0951522d9', '2024-11-11 12:00:00'),
('c4ca4238a0b923820dcc509a6f75849b', '2024-11-12 12:00:00'),
('98f13708210194c475687be6106a3b84', '2024-11-13 12:00:00'),
('3c59dc048e885024e6b0a1c72b1b6d1f', '2024-11-14 12:00:00'),
('aab3238922bcc25a6f606eb525ffdc56', '2024-11-15 12:00:00'),
('7c222fb2927d828af22f592134e893a', '2024-11-16 12:00:00'),
('16a7b23f2a6b9b27a94f374c96a9b70', '2024-11-17 12:00:00'),
('2d2d1fe74f529f8bc7fbc946bde5cd7', '2024-11-18 12:00:00'),
('0cc175b9c0f1b6a831c399e269772661', '2024-11-19 12:00:00');
