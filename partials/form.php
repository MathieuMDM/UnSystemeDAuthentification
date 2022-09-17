<div class="container">
    <div class="panel-heading">
        <h2>Inscription d'un nouvel employé</h2>
    </div>
    <div class="panel-body">
        <form action="admin-ouvriers.php?page=User&action=list" class="form-vertical" method="post">
            <fieldset>
                <div class="form-group" style="display:none">
                    <label for="parm0">Identifiant</label>
                    <input class="form-control" id="parm0" name="parm0" type="text" readonly value="{parm0}" />
                </div>
                <div class="form-group">
                    <label for="parm1">Nom</label>
                    <input class="form-control" id="parm1" name="parm1" type="text" {readonly} value="{parm1}" />
                </div>
                <div class="form-group">
                    <label for="parm2">Prénom</label>
                    <input class="form-control" id="parm2" name="parm2" type="text" {readonly} value="{parm2}" />
                </div>
                <div class="form-group">
                    <label for="parm3">Password</label>
                    <input class="form-control" id="parm3" name="parm3" type="text" {readonly} value="{parm3}" />
                </div>
                <div class="form-group">
                    <label for="parm4">Metier</label>
                    <input class="form-control" id="parm4" name="parm4" type="text" {readonly} value="{parm4}" />
                </div>
                <div class="form-group">
                    <label for="parm5">Email</label>
                    <input class="form-control" id="parm5" name="parm5" type="text" {readonly} value="{parm5}" />
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" id="action" name="action" value="{action}">
                        {lib_action}</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>