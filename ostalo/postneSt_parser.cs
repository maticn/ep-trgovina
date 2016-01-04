using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

using System.Net.Http;
using System.Net.Http.Headers;

namespace PostNumbers.Controllers
{
    public class DataObject
    {
        public string kraj { get; set; }
        public string postSt { get; set; }
    }

    public class HomeController : Controller
    {
        private const string URL = "http://sandbox.lavbic.net/OIS/api/kraji";
        private static string urlParameters = "?api_key=123";

        public ActionResult Index()
        {
            ViewBag.Title = "Home Page";
            string tabela = "";

            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri(URL);

            // Add an Accept header for JSON format.
            client.DefaultRequestHeaders.Accept.Add(
            new MediaTypeWithQualityHeaderValue("application/json"));

            // List data response.
            HttpResponseMessage response = client.GetAsync(urlParameters).Result;  // Blocking call!
            if (response.IsSuccessStatusCode)
            {
                // Parse the response body. Blocking!
                var dataObjects = response.Content.ReadAsAsync<IEnumerable<DataObject>>().Result;
                foreach (var d in dataObjects)
                {
                    string temp = d.postSt + " => " + "\"" + d.kraj + "\"" + ", ";
                    tabela = tabela + temp;
                }
                ViewBag.Tabela = tabela;
            }
            else
            {
                Console.WriteLine("{0} ({1})", (int)response.StatusCode, response.ReasonPhrase);
            }

            return View();
        }
    }
       
}
