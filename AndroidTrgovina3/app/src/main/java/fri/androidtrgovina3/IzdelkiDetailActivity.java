package fri.androidtrgovina3;

import android.app.ListActivity;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;

import fri.androidtrgovina3.model.Izdelki;
import fri.androidtrgovina3.model.IzdelkiMore;

public class IzdelkiDetailActivity extends ListActivity {

    private static final String TAG = IzdelkiDetailActivity.class.getCanonicalName();
    private TextView tv;
    private Izdelki izdelekPrejet;
    private IzdelkiMore izdelekDt;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_izdelki_detail);

        tv = (TextView) findViewById(R.id.textView1);

        izdelekPrejet = (Izdelki) getIntent().getSerializableExtra("izdelekSend");
        if(izdelekPrejet != null) {
            String ADDRESS_DETAIL = "http://10.0.2.2/netbeans/trgovina/api/izdelki/" + izdelekPrejet.idIzdelek;
            final RequestQueue queue = Volley.newRequestQueue(this);
            final StringRequest stringRequest = new StringRequest(Request.Method.GET, ADDRESS_DETAIL,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            final Gson gson = new Gson();
                            izdelekDt = gson.fromJson(response, IzdelkiMore.class);
                            tv.setText(izdelekDt.toString());
                        }
                    }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    //Toast.makeText(BookListActivity.this, "An error occurred.", Toast.LENGTH_LONG).show();
                    Log.w(TAG, "Exception: " + error.getLocalizedMessage());
                }
            });

            queue.add(stringRequest);
        }
    }

}
