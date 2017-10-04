        <p><a href="blog.php">Retour à la liste des billets</a></p>
        <div class="news">
            <h3>
                <?php echo htmlspecialchars($this->datas['billet']['titre']); ?>
                <em>le <?php echo $this->datas['billet']['date_creation_fr']; ?></em>
            </h3>
            
            <p>
            <?php
            echo nl2br(htmlspecialchars($this->datas['billet']['contenu']));
            ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php

        foreach ($this->datas['commentaires'] as $commentaire)
        {
            ?>
            <p><strong><?php echo htmlspecialchars($commentaire['auteur']); ?></strong> le <?php echo $commentaire['date_commentaire_fr']; ?></p>
            <p><?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?></p>
            <?php
        } // Fin de la boucle des commentaires
        ?>
