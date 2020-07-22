CREATE TRIGGER `admin_user_migration` AFTER INSERT ON `admins`
 FOR EACH ROW INSERT INTO `users`(`role`, `email`, `first_name`, `middle_name`, `last_name`, `client_id`, `address`, `state_id`, `country_id`, `city`, `mobile`, `name`, `email_verified_at`,
 `last_login`, `ip_address`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `gender`, `hobbies`, `profile_image`) 
SELECT '1' AS role, `email`, `name` as `first_name`, `name` as `middle_name`, `name` as `last_name`, '0' as `client_id`, 
'Villivakkam' as `address`, '35' as `state_id`, '101' as `country_id`, 
`city`, '600049' as `mobile`, `name`, null as `email_verified_at`, 
null as `last_login`, null as `ip_address`, `password`, `remember_token`, 1 as `status`, `created_at`, `updated_at`, `gender`, `hobbies`, `profile_image` from admins WHERE id=NEW.id;


CREATE TRIGGER `client_user_migration` AFTER INSERT ON `clients`
 FOR EACH ROW INSERT INTO `users`(`first_name`, `middle_name`, `last_name`, `address`, `state_id`, `country_id`, `city`, `mobile`, `name`, `email`, `role`, `email_verified_at`,
 `last_login`, `ip_address`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `gender`,  `hobbies`, `profile_image`) 
SELECT `first_name`, `middle_name`, `last_name`, `address`, `state_id`, `country_id`, `city`,
`mobile`, `name`, `email`, '2' AS role, `email_verified_at`, `last_login`, `ip_address`, `password`, 
`remember_token`, `status`, `created_at`, `updated_at`, `gender`, `hobbies`, `profile_image`
from clients WHERE id=NEW.id;

