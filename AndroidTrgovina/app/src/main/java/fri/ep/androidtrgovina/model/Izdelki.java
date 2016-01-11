package fri.ep.androidtrgovina.model;

import java.util.ArrayList;
import java.util.List;

public class Izdelki {

    private String idIzdelek;
    private String ime;
    private String opis;
    private String cena;
    private String aktivno;
    private Object avgOcena;
    private String countOcena;
    private List<Object> slike = new ArrayList<Object>();

    /**
     * No args constructor for use in serialization
     * 
     */
    public Izdelki() {
    }

    /**
     * 
     * @param avgOcena
     * @param slike
     * @param aktivno
     * @param idIzdelek
     * @param countOcena
     * @param opis
     * @param ime
     * @param cena
     */
    public Izdelki(String idIzdelek, String ime, String opis, String cena, String aktivno, Object avgOcena, String countOcena, List<Object> slike) {
        this.idIzdelek = idIzdelek;
        this.ime = ime;
        this.opis = opis;
        this.cena = cena;
        this.aktivno = aktivno;
        this.avgOcena = avgOcena;
        this.countOcena = countOcena;
        this.slike = slike;
    }

    /**
     * 
     * @return
     *     The idIzdelek
     */
    public String getIdIzdelek() {
        return idIzdelek;
    }

    /**
     * 
     * @param idIzdelek
     *     The idIzdelek
     */
    public void setIdIzdelek(String idIzdelek) {
        this.idIzdelek = idIzdelek;
    }

    /**
     * 
     * @return
     *     The ime
     */
    public String getIme() {
        return ime;
    }

    /**
     * 
     * @param ime
     *     The ime
     */
    public void setIme(String ime) {
        this.ime = ime;
    }

    /**
     * 
     * @return
     *     The opis
     */
    public String getOpis() {
        return opis;
    }

    /**
     * 
     * @param opis
     *     The opis
     */
    public void setOpis(String opis) {
        this.opis = opis;
    }

    /**
     * 
     * @return
     *     The cena
     */
    public String getCena() {
        return cena;
    }

    /**
     * 
     * @param cena
     *     The cena
     */
    public void setCena(String cena) {
        this.cena = cena;
    }

    /**
     * 
     * @return
     *     The aktivno
     */
    public String getAktivno() {
        return aktivno;
    }

    /**
     * 
     * @param aktivno
     *     The aktivno
     */
    public void setAktivno(String aktivno) {
        this.aktivno = aktivno;
    }

    /**
     * 
     * @return
     *     The avgOcena
     */
    public Object getAvgOcena() {
        return avgOcena;
    }

    /**
     * 
     * @param avgOcena
     *     The avg_ocena
     */
    public void setAvgOcena(Object avgOcena) {
        this.avgOcena = avgOcena;
    }

    /**
     * 
     * @return
     *     The countOcena
     */
    public String getCountOcena() {
        return countOcena;
    }

    /**
     * 
     * @param countOcena
     *     The count_ocena
     */
    public void setCountOcena(String countOcena) {
        this.countOcena = countOcena;
    }

    /**
     * 
     * @return
     *     The slike
     */
    public List<Object> getSlike() {
        return slike;
    }

    /**
     * 
     * @param slike
     *     The slike
     */
    public void setSlike(List<Object> slike) {
        this.slike = slike;
    }

}
