<?php
$lang = getLanguage();
?>
<section class="homeSection">
    <h3><?= htmlspecialchars($lang === 'fr' ? 'Participez à la vie de l\'association !' : 'Get involved in the life of the association!')?></h3>
    <article>
        <div class="texte">
            <p>
              <?= $lang === 'fr'
                ? htmlspecialchars('Aidez nous ! Inscrivez vous ') . '<a href="#">ici</a>' . htmlspecialchars(' pour une demi-journée de bénévolat.')
                : htmlspecialchars('Help us! Sign up ') . '<a href="#">here</a>' . htmlspecialchars(' for a half-day of volunteering.')
              ?>
            </p>
            <p>
              <?= $lang === 'fr'
                ? htmlspecialchars('Vous ne faites pas partie de nos membres ? Vous voulez participer ? C\'est ') . '<a href="#">' . htmlspecialchars('ici !') . '</a>'
                : htmlspecialchars('Not a member yet? Want to take part? Join us ') . '<a href="#">' . htmlspecialchars('here!') . '</a>'
              ?>
            </p>
            <p>
              <?= $lang === 'fr'
                ? htmlspecialchars('Vous ne pouvez pas investir votre temps ? Faites nous un don en cliquant ') . '<a href="#">' . htmlspecialchars('ici') . '</a>.'
                : htmlspecialchars('Can\'t invest your time? Support us with a donation by clicking ') . '<a href="#">' . htmlspecialchars('here') . '</a>!'
              ?>
            </p>
        </div>
        <img src="assets/img/images/moyenne_image_femme_travaille.jpg" alt="Femme participant à la vie de l'association">
    </article>
</section>
<div class="separateur"></div>
<section class="homeSection">
    <h3><?= htmlspecialchars($lang === 'fr' ? 'Nous rejoindre ? C\'est l\'affaire de quelques étapes !' : 'Joining us? It\'s just a few easy steps!')?></h3>
    <article>
        <img src="assets/img/images/moyenne_image_liste_cocher.jpg" alt="Image d'une liste représentant l'acces à l'assiciation">
        <div class="texte">
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? '1. Venez nous rendre visite !'
                :'1. Come and visit us!')?>
            </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? '2. Payez la cotisation pour devenir membre à part entière. Seulement 20€ par an et par personne !'
                : '2. Pay the membership fee to become a full member. Only €20 per year per person!')?>
            </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? '3. Créez votre compte membre sur FACIL\'ADMIN !'
                : '3. Create your member account on FACIL\'ADMIN!')?>
            </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? '4. Inscrivez vous avec votre compte à une ou plusieurs demies journées.'
                : '4. Sign up with your account for one or more half-days.')?>
            </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? '5. On a tous hâte de vous voir !'
                : '5. We are all looking forward to seeing you!')?>
            </p>
        </div>
    </article>
</section>
<div class="separateur"></div>
<section class="homeSection">
    <h3>
      <?= htmlspecialchars($lang === 'fr'
        ? 'Quelles que soient vos compétences, vous aurez toujours une place chez nous !'
        : 'Whatever your skills, you will always have a place with us!')?>
    </h3>
    <article>
        <div class="texte">
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? 'Aidez nos bénéficiaires à remplir leurs démarches en ligne.'
                : 'Help our beneficiaries complete their online procedures.')?>
            </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? 'Participez à la vie de l\'association ! Aidez nous à développer nos différentes applications.'
                : 'Get involved in the life of the association! Help us develop our various applications.')?>
              </p>
            <p>
            <?= htmlspecialchars($lang === 'fr'
              ? 'Réparez et formatez des PC fixes pour de la vente reconditionnée.'
              : 'Repair and format desktop PCs for refurbished sales.')?>
          </p>
            <p>
              <?= htmlspecialchars($lang === 'fr'
                ? 'Participez à nos démarches administratives, comptables, fiscales, etc.'
                : 'Take part in our administrative, accounting, tax procedures, etc.')?>
            </p>
        </div>
        <img src="assets/img/images/moyenne_image_homme_travaille.jpg" alt="Femme participant à la vie de l'association">
    </article>
</section>