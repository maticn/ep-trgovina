package fri.androidtrgovina2.model;

import java.io.Serializable;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class IzdelkiMore implements Serializable {

    public int idIzdelek;
    public String ime;
    public String opis;
    public double cena;
    public double avgOcena;
    public int stOcen;

    @Override
    public String toString() {
        return String.format("id: %d \nime: %s \nopis: %s \ncena: %.2f EUR \nocena: %.2f \nstOcen: %d", idIzdelek, ime, opis, cena, avgOcena, stOcen);
    }

}
