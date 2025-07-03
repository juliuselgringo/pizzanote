SELECT s.restaurant, s.item, s.sous_item, (ROUND(AVG(s.note)) * n.ponderation) AS note_pondérée FROM session s LEFT JOIN notation n USING (id_note)GROUP BY s.restaurant, s.item, s.sous_item, n.ponderation ORDER BY s.restaurant, s.item;

CREATE VIEW restaurant_result_sousitem AS SELECT s.restaurant, s.item, s.sous_item, (ROUND(AVG(s.note)) * n.ponderation) AS note_pondérée FROM session s LEFT JOIN notation n USING (id_note)GROUP BY s.restaurant, s.item, s.sous_item, n.ponderation ORDER BY s.restaurant, s.item;

CREATE VIEW restaurant_result_item AS SELECT restaurant, item, SUM(note_pondérée) AS score_par_item FROM restaurant_result_sousitem GROUP BY restaurant, item ORDER BY restaurant;

CREATE VIEW best_restaurant AS SELECT restaurant, SUM(score_par_item) AS score FROM restaurant_result_item GROUP BY restaurant ORDER BY score DESC;