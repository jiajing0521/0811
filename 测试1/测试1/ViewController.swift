//
//  ViewController.swift
//  测试1
//
//  Created by dllo on 16/12/5.
//  Copyright © 2016年 dllo. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
//        let url = NSURL.init(string:"http://www.baidu.com");
        let url = NSBundle.mainBundle().URLForResource("练习复合改变", withExtension: "html")
        
        var request = NSURLRequest.init(URL: url!);
        
        let webView = UIWebView.init(frame: CGRectMake(0, 0, 300, 500));
        
        webView.loadRequest(request);
        self.view.addSubview(webView);
        
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

