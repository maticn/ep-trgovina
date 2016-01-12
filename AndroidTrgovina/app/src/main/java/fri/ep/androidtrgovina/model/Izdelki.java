package fri.ep.androidtrgovina.model;

import java.util.HashMap;
import java.util.Map;

public class Izdelki {

    public String idIzdelek;
    public String ime;
    public String opis;
    public String cena;
    private Map<String, Object> additionalProperties = new HashMap<String, Object>();

    public Map<String, Object> getAdditionalProperties() {
        return this.additionalProperties;
    }

    public void setAdditionalProperty(String name, Object value) {
        this.additionalProperties.put(name, value);
    }

}
