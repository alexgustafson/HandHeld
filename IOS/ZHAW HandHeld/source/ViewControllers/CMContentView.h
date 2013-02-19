//
//  CMContentView.h
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHFieldModel.h"
#import "HHArticleModel.h"

@interface CMContentView : UIViewController
{
    IBOutlet UIScrollView* mainScrollView;
    HHArticleModel* article;
    SqLiteDatabaseManager* dbManager;
    
    UIImage* mainImage;
    IBOutlet UIImageView* mainImageView;
    IBOutlet UIWebView* htmlText;
    
    NSString* htmlString;
}
@property (nonatomic, retain) IBOutlet UIScrollView* mainScrollView;
@property (nonatomic, retain) HHArticleModel* article;
@property (nonatomic, retain) SqLiteDatabaseManager* dbManager;
@property (nonatomic, retain) UIImage* mainImage;
@property (nonatomic, retain) IBOutlet UIImageView* mainImageView;
@property (nonatomic, retain) IBOutlet UIWebView* htmlText;


- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db;

@end
