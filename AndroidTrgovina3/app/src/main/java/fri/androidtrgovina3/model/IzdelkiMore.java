package fri.androidtrgovina3.model;

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
        return String.format("id: %d \n ime: %s \n opis: %s \n cena: (%.2f EUR) \n ocena: %.2f \n stOcen: %d", idIzdelek, ime, opis, cena, avgOcena, stOcen);
    }

}
