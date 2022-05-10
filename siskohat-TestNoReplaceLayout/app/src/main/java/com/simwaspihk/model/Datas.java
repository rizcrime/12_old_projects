package com.simwaspihk.model;

/**
 * Created by creatorbe on 5/24/17.
 */

public class Datas {
    int imgsrc;
    String name;
    public Datas(int imgsrc, String name)
    {
        this.setImgsrc(imgsrc);
        this.setName(name);
    }
    public int getImgsrc() {
        return imgsrc;
    }

    public void setImgsrc(int imgsrc) {
        this.imgsrc = imgsrc;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
}
