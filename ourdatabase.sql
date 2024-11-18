-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 03:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `applications` (
  `application_id` int(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `application_date` timestamp DEFAULT current_timestamp,
  FOREIGN KEY (job_id) REFERENCES jobs(job_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE jobs (
  `job_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `posted_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `posted_by` int(50) NOT NULL,
  FOREIGN KEY (posted_by) REFERENCES users(user_id) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `users` (
  `user_id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

