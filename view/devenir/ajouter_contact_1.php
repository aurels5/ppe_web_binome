<div class="row">
    <div class="col-lg-6">
        <form method="post" action="ajouter_promo.php">

           <fieldset>
               <div class="form-group">
                    <legend>Ajouter une fiche contact</legend> <!-- Titre du fieldset --> 
                    <p>Vous pourrez modifier cette fiche contact ou en ajouter une nouvelle.</p>
                    
                    <label for="promo">Quelle promotion ?</label>
                    <select>
                        <option>1boucle foreach</option>
                        <option>2</option>
                    </select>

                    &nbsp&nbsp
                    <br>
                    
                    <label for="nom_prenom">Nom/prénom de l'élève ?</label>
                    <select>
                        <option>1</option>
                        <option>2boucle foreach</option>
                    </select>
               </div>
           </fieldset>

           <fieldset>
               <legend>Détails du contact</legend> <!-- Titre du fieldset -->
               
               <label for="date_contact">Date de la prise de contact</label>
               <input type="date" name="date_contact" value="" />
               
               <br>
               
               <label for="prenom">Informations Post-BTS SIO</label>
                <select>
                    <option>Poursuite d'études</option>
                    <option>Travail CDD</option>
                    <option>Travail CDI</option>
                    <option>Chômage/Recherche d'emploi</option>
                    
                </select> 
               
                <br>
               
                <input type="checkbox" class="form-check-input" name="international" id="international">
                <label class="form-check-label" for="international">
                    Poursuite à l'international
                </label>
                
              
               
               
                <br>
               <p>
                   <label for="precisions">Précisions :</label>
                   <textarea name="precisions" id="precisions" cols="40" rows="4" class="form-control"></textarea>
               </p>
           </fieldset>

            <button type="submit" class="btn btn-primary">Valider</button>

        </form>
    </div><!--fin col-->
</div><!--fin row-->