//
//  CMMapViewController.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 19.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"
#import "CMLocationItemView.h"

@interface CMMapViewController : UINavigationController
{
    
    HHArticleModel* article;
    SqLiteDatabaseManager* dbManager;
    NSMutableArray* locationItems;
    UIViewController* rootViewController;
    UIImage* mapImage;
    
}
@property (nonatomic, retain) HHArticleModel *article;
@property (nonatomic, retain) SqLiteDatabaseManager *dbManager;
@property (nonatomic, retain) NSMutableArray *locationItems;
@property (nonatomic, retain) UIViewController* rootViewController;
@property (nonatomic, retain) UIImage* mapImage;

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db;


@end
