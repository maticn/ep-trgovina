package fri.androidtrgovina3.model;

import java.io.Serializable;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class Izdelki implements Serializable {

    public int idIzdelek;
    public String ime;

    @Override
    public String toString() {
        return String.format("%d: \t %s", idIzdelek, ime);
    }

}
