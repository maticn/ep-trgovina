package fri.ep.androidtrgovina;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;

import java.util.ArrayList;
import java.util.List;

import fri.ep.androidtrgovina.model.Izdelki;
import fri.ep.androidtrgovina.model.IzdelkiResponse;
import fri.ep.androidtrgovina.volley.VolleyTrgovinaRequest;

public class MainActivity extends AppCompatActivity {

    public static final String ADDRESS = "http://10.0.2.2/netbeans/trgovina/api/izdelki";

    private static final String TAG = MainActivity.class.getCanonicalName();
    private ListView articlesTable;
    private Button refreshButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        articlesTable = (ListView) findViewById(R.id.articlesTable_lv);
        refreshButton = (Button) findViewById(R.id.refresh_btn);
        refreshButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final RequestQueue queue = Volley.newRequestQueue(MainActivity.this);
                final VolleyTrgovinaRequest request = new VolleyTrgovinaRequest(ADDRESS,
                        new Response.Listener<IzdelkiResponse>() {
                            @Override
                            public void onResponse(IzdelkiResponse response) {
                                final List<Izdelki> vsiIzdelki = new ArrayList<>();

                                for (Izdelki izdelek : response.izdelkiList) {
                                    vsiIzdelki.add(izdelek);
                                }

                                final ArrayAdapter<Izdelki> aa = new ArrayAdapter<>(MainActivity.this,
                                        android.R.layout.simple_list_item_1, vsiIzdelki);
                                articlesTable.setAdapter(aa);
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Log.w(TAG, " Volley error: " + error.getLocalizedMessage());
                                articlesTable.setAdapter(null);
                            }
                        });

                queue.add(request);
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
