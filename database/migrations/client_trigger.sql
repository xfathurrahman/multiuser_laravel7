INSERT INTO `users`(`client_id`, `first_name`, `middle_name`, `last_name`, `profile_image`, `gender`,
 `hobbies`, `address`, `country_id`, `state_id`, `city`, `mobile`, `name`, `email`,  `role`,
 `email_verified_at`, `last_login`, `ip_address`, `password`, `is_editor`, `remember_token`,
  `status`, `created_at`, `updated_at`) 
  SELECT `id` as `client_id`, `first_name`, `middle_name`, `last_name`, `profile_image`, `gender`,
 `hobbies`, `address`, `country_id`, `state_id`, `city`, `mobile`, `name`, `email`, '2' AS role,
 `email_verified_at`, `last_login`, `ip_address`, `password`, `is_editor`, `remember_token`,
  `status`, `created_at`, `updated_at` from clients WHERE id=NEW.id;