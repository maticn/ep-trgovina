package fri.ep.androidtrgovina.volley;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkResponse;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.HttpHeaderParser;
import com.google.gson.Gson;
import com.google.gson.JsonSyntaxException;

import java.io.UnsupportedEncodingException;
import java.util.HashMap;
import java.util.Map;

import fri.ep.androidtrgovina.model.Izdelki;
import fri.ep.androidtrgovina.model.IzdelkiResponse;

public class VolleyTrgovinaRequest extends Request<IzdelkiResponse> {
    private static final Map<String, String> HEADERS = new HashMap<>();

    static {
        HEADERS.put("accept", "application/json");
    }

    private final Gson gson = new Gson();
    private final Response.Listener<IzdelkiResponse> listener;

    public VolleyTrgovinaRequest(String url, Response.Listener<IzdelkiResponse> listener, Response.ErrorListener errorListener) {
        super(Method.GET, url, errorListener);
        this.listener = listener;
    }

    @Override
    public Map<String, String> getHeaders() throws AuthFailureError {
        return HEADERS;
    }

    @Override
    protected void deliverResponse(IzdelkiResponse response) {
        listener.onResponse(response);
    }

    @Override
    protected Response<IzdelkiResponse> parseNetworkResponse(NetworkResponse response) {
        try {
            String json = new String(response.data, HttpHeaderParser.parseCharset(response.headers));
//            json = json.substring(1, json.length() - 1);
//            json = "{" + json + "}";
//            System.out.println(json);
//            String nesto = json.substring(100, 110);
//            System.out.println(nesto);
            return Response.success(gson.fromJson(json, IzdelkiResponse.class), HttpHeaderParser.parseCacheHeaders(response));
        } catch (UnsupportedEncodingException | JsonSyntaxException e) {
            return Response.error(new ParseError(e));
        }
    }
}
