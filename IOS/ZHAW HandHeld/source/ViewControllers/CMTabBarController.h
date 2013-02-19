//
//  CMTabBarController.h
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "HHFieldModel.h"
#import "SqLiteDatabaseManager.h"

@interface CMTabBarController : UITabBarController
{

    SqLiteDatabaseManager* dbManager;
    HHArticleModel* article;
    NSMutableArray* tabBarItems;

}

@property (nonatomic, retain) SqLiteDatabaseManager* dbManager;
@property (nonatomic, retain) HHArticleModel* article;
@property (nonatomic, retain) NSMutableArray* tabBarItems;

- (void)initializeWithField:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db;

@end
