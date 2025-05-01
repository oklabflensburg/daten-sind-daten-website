---

date = 2025-01-01

---

# Topografie Schleswig-Holstein


## Datenquelle

Downloadclient Digitales Geländemodell - DGM 1

- <https://geodaten.schleswig-holstein.de/gaialight-sh/_apps/dladownload/dl-dgm1.html>
- Genauigkeit 1 m


## Herausforderungen

- Datenmenge
    - 18.669 Einzeldateien, 1 qkm
        - XYZ-Format
            - Textdatei mit 1.000.000 Zeilen
            - Insgesamt ~ 18.669.000.000 einzelne Messwerte
            - ca. 520 GB
    - Projektion im EPSG:25832 <https://epsg.io/25832>
        - Projektion aller Datenpunke erforderlich


## Umsetzung

**Schritt 1 - Datenkompression**
- Entwicklung eines eigenen Datenformats - CVF2
    - Kompression von 520 GB auf 30.64 GB
    - Faktor 1 : 16.97
    - Messwerte unverändert
    - Schneller Zugriff auf einzelne Messwerte im gesammten Datensatz
        - CVF2TileManager mit Cache

**Schritt 2 - Projektion**
- Projektion aller Messwerte zu EPSG:3578 (Mercator Projektion)
    - Referenzzoomstufe 18
- Downsampling für alle Zoomstufen < 18