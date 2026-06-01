--
-- Index pour la table `llx_ticket_extrafields`
--
ALTER TABLE `llx_ticket_extrafields`
  ADD UNIQUE KEY `uk_ticket_extrafields` (`fk_object`),
  ADD KEY `idx_ticket_extrafields` (`fk_object`);